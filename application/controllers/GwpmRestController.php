<?php

class GwpmRestController extends WP_REST_Controller
{

    protected $_userLoginPreference;

    function getUserLoginPreference ()
    {
        if (! isset($this->_userLoginPreference)) {
            $this->_userLoginPreference = get_option(GWPM_USER_LOGIN_PREF);
        }
        return $this->_userLoginPreference;
    }

    /**
     * s
     * Register the routes for the objects of the controller.
     *
     * READABLE = 'GET'
     * CREATABLE = 'POST'
     * EDITABLE = 'POST, PUT, PATCH'
     * DELETABLE = 'DELETE'
     * ALLMETHODS = 'GET, POST, PUT, PATCH, DELETE'
     */
    public function register_routes ()
    {
        appendLog('Loading the routes for the REST services ');
        $version = '1';
        $namespace = 'gwpmrest/v' . $version;
        $info = 'info';
        $users = 'users';
        $user = 'user';
        $me = 'me';
        register_rest_route($namespace, '/' . $info, 
                array(
                        array(
                                'methods' => WP_REST_Server::READABLE,
                                'callback' => array(
                                        $this,
                                        'gwpm_get_informations'
                                ),
                                'permission_callback' => array(
                                        $this,
                                        'get_gwpm_access_info'
                                ),
                                'args' => array(
                                        'operation' => GWPM_REST_GET_INFO
                                )
                        )
                ));
        register_rest_route($namespace, '/' . $users, 
                array(
                        array(
                                'methods' => WP_REST_Server::CREATABLE,
                                'callback' => array(
                                        $this,
                                        'gwpm_search_user'
                                ),
                                'permission_callback' => array(
                                        $this,
                                        'get_gwpm_access_info'
                                ),
                                'args' => array(
                                        'operation' => GWPM_REST_SEARCH_USERS
                                )
                        )
                ));
        register_rest_route($namespace, '/' . $user . '/(?P<id>[\d]+)', 
                array(
                        array(
                                'methods' => WP_REST_Server::READABLE,
                                'callback' => array(
                                        $this,
                                        'gwpm_get_user'
                                ),
                                'permission_callback' => array(
                                        $this,
                                        'get_gwpm_access_info'
                                ),
                                'args' => array(
                                        'operation' => GWPM_REST_GET_USER,
                                        'id' => array(
                                                'validate_callback' => function ($param, $request, $key)
                                                {
                                                    return is_numeric($param);
                                                }
                                        )
                                )
                        )
                ));
        register_rest_route($namespace, '/' . $user . '/' . $me, 
                array(
                        array(
                                'methods' => WP_REST_Server::READABLE,
                                'callback' => array(
                                        $this,
                                        'gwpm_get_my_user'
                                ),
                                'permission_callback' => array(
                                        $this,
                                        'get_gwpm_access_info'
                                ),
                                'args' => array(
                                        'operation' => GWPM_REST_GET_MY_DETAILS
                                )
                        )
                ));
    }

    /**
     * Get user permission to use this API
     *
     * @param WP_REST_Request $request
     *            Full data about the request.
     * @return WP_Error|WP_REST_Response
     */
    public function get_gwpm_access_info ($request)
    {
        $opsName = null ;
        $attrs = $request->get_attributes() ;
        if (isset($attrs) && is_array($attrs)) {
            $args = $attrs['args'] ;
            if (isset($args) && is_array($args)) {
                $opsName = $args['operation'] ;
            }
        }
        // $opsName = $request->get_attributes()['args']['operation'];
        if ($opsName == null)
            return false ;
        appendLog('Operation name: ' . $opsName);
        $userPref = $this->getUserLoginPreference();
        appendLog('User pref: ' . $userPref);
        $opsAllowed = false;
        if ($opsName == GWPM_REST_GET_INFO) {
            return true;
        } else {
            if (is_user_logged_in()) {
                if (current_user_can('level_10')) {
                    appendLog('Admin user !');
                    return true;
                } elseif (current_user_can('matrimony_user') && $userPref == 1) {
                    appendLog('Matrimony user !');
                    return true;
                } elseif ($userPref == 2) {
                    appendLog('User pref = 2 and user is logged in !');
                    return true;
                } else {
                    if ($userPref == 3) {
                        appendLog('User pref = 3 and user is logged in !');
                        if ($opsName == GWPM_REST_SEARCH_USERS || $opsName == GWPM_REST_GET_USER ||
                                 $opsName == GWPM_REST_GET_MY_DETAILS) {
                            appendLog('Allowed ops for user !');
                            return true;
                        } else {
                            appendLog('Unallowed operations request !');
                            return new WP_Error('gwpm_rest_unknown', 'Unknown Operation', 
                                    array(
                                            'status' => 400
                                    ));
                        }
                    } else {
                        appendLog('Unhandled scenario, Please check !!');
                        return new WP_Error('gwpm_rest_forbidden', 'Not a valid Matrimonial User', 
                                array(
                                        'status' => 403
                                ));
                    }
                }
            } elseif ($userPref == 3) {
                appendLog('User pref = 3 and user is logged in !');
                if ($opsName == GWPM_REST_SEARCH_USERS || $opsName == GWPM_REST_GET_USER ||
                         $opsName == GWPM_REST_GET_MY_DETAILS) {
                    appendLog('Allowed ops for user !');
                    return true;
                } else {
                    appendLog('Unallowed operations request !');
                    return new WP_Error('gwpm_rest_unknown', 'Unknown Operation', 
                            array(
                                    'status' => 400
                            ));
                }
            } else {
                appendLog('User not logged in !');
            }
        }
        
        return $opsAllowed;
    }

    /**
     * Get a GWPM general infromations
     *
     * @param WP_REST_Request $request
     *            Full data about the request.
     * @return WP_Error|WP_REST_Response
     */
    public function gwpm_get_informations ($request)
    {
        $oauth10a = false;
        $existingRecords = get_option(GWPM_OAUTH_10A_CONFIG);
        if (isset($existingRecords)) {
            $oauth10a = true;
        }
        $data = array();
        $data['gwpm_user_preference'] = "ups." . $this->getUserLoginPreference();
        $data['gwpm_internal_version'] = GWPM_INTERNAL_VERSION;
        $data['gwpm_oauth10a_setup'] = $oauth10a;
        $data['gwpm_matrimonial_user'] = current_user_can('matrimony_user');
        $data['gwpm_logged_user'] = get_current_user_id();
        $data['gwpm_gallery_url'] = GWPM_GALLERY_URL ;
        $data['gwpm_public_img_url'] = GWPM_PUBLIC_IMG_URL;
        $resp = GwpmRestResponseVO::getInstance($data);
        appendLog($resp);
        return new WP_REST_Response($resp, 200);
    }

    /**
     * Get my profile data
     *
     * @param WP_REST_Request $request
     *            Full data about the request.
     * @return WP_Error|WP_REST_Response
     */
    public function gwpm_get_my_user ($request)
    {
        $profileModel = new GwpmProfileModel();
        $searchResult = $profileModel->getUserObj(get_current_user_id());
        $resp = GwpmRestResponseVO::getInstance($searchResult);
        appendLog($resp);
        return new WP_REST_Response($resp, 200);
    }

    /**
     * Get my profile data
     *
     * @param WP_REST_Request $request
     *            Full data about the request.
     * @return WP_Error|WP_REST_Response
     */
    public function gwpm_get_user ($request)
    {
        $parameters = $request->get_url_params();
        
        $profileModel = new GwpmProfileModel();
        $searchResult = $profileModel->getUserObj($parameters['id']);
        $resp = GwpmRestResponseVO::getInstance($searchResult);
        appendLog($resp);
        return new WP_REST_Response($resp, 200);
    }
    
    /**
     * Search user profiles
     *
     * @param WP_REST_Request $request
     *            Full data about the request.
     * @return WP_Error|WP_REST_Response
     */
    public function gwpm_search_user($request)
    {
        // appendLog($request) ;
        $jsonParams = $request->get_json_params();
       appendLog("Obtained body params : ") ; appendLog($jsonParams) ;
        
        $searchModel = new GwpmSearchModel();
        $searchResult = $searchModel->searchUsersRest($jsonParams['data']);
        $resp = GwpmRestResponseVO::getInstance($searchResult);
        appendLog($resp);
        return new WP_REST_Response($resp, 200);
    }
    
    /**
     * Get profile data by id
     *
     * @param WP_REST_Request $request
     *            Full data about the request.
     * @return WP_Error|WP_REST_Response
     */
    public function __gwpm_get_user ($request)
    {
        $_keys = getDynamicFieldKeys();
        $data['userId'] = 'gwpm_' . get_current_user_id();
        $searchModel = new GwpmSearchModel();
        $searchResult = $searchModel->searchUsersRest($data);
        $resp = GwpmRestResponseVO::getInstance($searchResult);
        appendLog($resp);
        return new WP_REST_Response($resp, 200);
    }
}

