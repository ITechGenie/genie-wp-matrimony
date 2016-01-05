<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
<?php if(!$this->isEditMode() && !$this->isUpdateMode())
{?> - <a class='edit-mode-link' href='<?php $this->get_gwpm_edit_link(); ?>'>Edit Profile</a><?php }
	else { echo "" ; } ?>

<?php
$modelObj = $this->get('model');
?>
<form name="gwpm-profile-form" class="form-horizontal squirrel" action="<?php $this->getActionURL(); ?>" method="post" enctype="multipart/form-data">
		<div class="form-group form-group-sm">
			<div class="col-sm-8 col-sm-offset-4">
				<h4 class="text-muted">Basic Information</h4>
			</div>
		</div>
		<div class="form-group form-group-sm hide">
			<label for="userId" class="col-sm-4 control-label">User ID:</label>
			<div class="col-sm-6">
				<input name="userId" id="userId" class="form-control" value="<?php echo $modelObj->userId ; ?>" maxLength="25" />
			</div>
		</div>
		<div class="form-group form-group-sm required">
			<label for="gwpm_full_name" class="col-sm-4 control-label">Full Name:</label>
			<div class="col-sm-6">
				<input class="form-control" name="gwpm_full_name" id="gwpm_full_name" type="text" value="<?php echo $modelObj->gwpm_full_name ; ?>" maxLength="25" />
			</div>
		</div>
		<div class="form-group form-group-sm required">
			<label for="user_email" class="col-sm-4 control-label">Email:</label>
			<div class="col-sm-6">
				<input class="form-control" type="email" name="user_email" id="user_email" value="<?php echo gwpm_echo ( $modelObj->user_email ); ?>" maxLength="25" />
			</div>
		</div>
		<div class="form-group form-group-sm required">
			<label for="gwpm_gender" class="col-sm-4 control-label">Gender:</label>
			<div class="col-sm-6">
				<?php $this->getSelectItem(getGenderOptions(), 'gwpm_gender', ($modelObj->gwpm_gender)) ; 	?>
			</div>
		</div>
		<div class="form-group form-group-sm required">
			<label for="gwpm_resident_address" class="col-sm-4 control-label">Resident Address:</label>
			<div class="col-sm-6">
				<textarea rows="4" name="gwpm_resident_address" id="gwpm_resident_address" maxLength="200" rows="4" cols="60"><?php gwpm_echo( $modelObj->gwpm_resident_address ); ?></textarea>
			</div>
		</div>
		<div class="form-group form-group-sm">
			<label for="gwpm_expectation" class="col-sm-4 control-label">Expectation:</label>
			<div class="col-sm-6">
				<?php $this->getSelectItem(getExpectationOptions(), 'gwpm_expectation', ($modelObj->gwpm_expectation)) ; 	?>
			</div>
		</div>
		<div class="form-group form-group-sm">
			<label for="gwpm_hobbies_activities" class="col-sm-4 control-label">Hobbies &amp; Activities:</label>
			<div class="col-sm-6">
				<input class="form-control" type="text"  name="gwpm_hobbies_activities" id="gwpm_hobbies_activities" value="<?php echo ( $modelObj->gwpm_hobbies_activities ); ?>" maxLength="100" />
			</div>
		</div>
		<div class="form-group form-group-sm">
			<label for="description" class="col-sm-4 control-label">About You:</label>
			<div class="col-sm-6">
				<textarea class="form-control" name="description" id="description" maxLength="500"  rows="4" cols="60"><?php gwpm_echo( $modelObj->description ); ?></textarea>
			</div>
		</div>
		<div class="form-group form-group-sm">
			<div class="col-sm-8 col-sm-offset-4">
				<h4 class="text-muted">Physical Apprearance</h4>
			</div>
		</div>
		<div class="form-group form-group-sm required">
			<label for="gwpm_physical[height]" class="col-sm-4 control-label">Height:</label>
			<div class="col-sm-6">
				<input class="form-control" type="text"  name="gwpm_physical[height]" id="gwpm_physical[height]"
							value="<?php gwpm_echo ( $modelObj->gwpm_physical['height'] ); ?>" maxLength="5" />
			</div>
		</div>

		<div class="form-group form-group-sm required">
			<label for="gwpm_physical[weight]" class="col-sm-4 control-label">Weight:</label>
			<div class="col-sm-6">
				<input class="form-control" type="text"  name="gwpm_physical[weight]" id="gwpm_physical[weight]"
							value="<?php gwpm_echo ( $modelObj->gwpm_physical['weight'] ); ?>" maxLength="5" placeholder="in kg"/>
			</div>
		</div>

		<div class="form-group form-group-sm">
			<label for="gwpm_physical[color_complexion]" class="col-sm-4 control-label">Color Complexion:</label>
			<div class="col-sm-6">
				<input class="form-control" type="text"  name="gwpm_physical[color_complexion]" id="gwpm_physical[color_complexion]"
							value="<?php gwpm_echo ( $modelObj->gwpm_physical['color_complexion'] ); ?>" maxLength="25" />
			</div>
		</div>

		<div class="form-group form-group-sm">
			<label for="gwpm_physical[body_type]" class="col-sm-4 control-label">Body Type:</label>
			<div class="col-sm-6">
				<?php $this->getSelectItem(getPhysicalType(), "gwpm_physical[body_type]", ($modelObj->gwpm_physical['body_type'])) ; 	?>
			</div>
		</div>

		<div class="form-group form-group-sm">
			<div class="col-sm-8 col-sm-offset-4">
				<h4 class="text-muted">Education &amp; Work Information</h4>
			</div>
		</div>

		<div>
					<div class="form-group form-group-sm required">
						<label class="col-sm-4 control-label">Qualification Degree:</label>
						<div class="col-sm-6">
							<?php $this->getSelectItem(getQualificationOptions(), 'gwpm_education[qualification]', ($modelObj->gwpm_education['qualification'])) ; ?>
						</div>
					</div>
					<div class="form-group form-group-sm">
						<label class="col-sm-4 control-label">Qualification Details</label>
						<div class="col-sm-6"><input class="form-control"  type="text"  name="gwpm_education[specialization]" id="gwpm_education[specialization]"
							value="<?php gwpm_echo ( $modelObj->gwpm_education['specialization'] ); ?>" maxLength="250" />
							</div>
					</div>
					<div class="form-group form-group-sm">
						<label class="col-sm-4 control-label">Employement Status:</label>
						<div class="col-sm-6">
							<?php $this->getSelectItem(getEmploymentStatusOptions(), 'gwpm_education[status]', ($modelObj->gwpm_education['status'])) ; 	?>
							</div>
					</div>
					<div class="form-group form-group-sm">
						<label class="col-sm-4 control-label">Work Place Information:</label>
						<div class="col-sm-6"><input class="form-control"  type="text"  name="gwpm_work[place]" id="gwpm_work[place]"
							value="<?php gwpm_echo ( $modelObj->gwpm_work['place'] ); ?>" maxLength="500" /></div>
					</div>
					<div class="form-group form-group-sm">
						<label class="col-sm-4 control-label">Workplace Address:</label>
						<div class="col-sm-6">
							<textarea name="gwpm_workplace_address" id="gwpm_workplace_address" maxLength="500" rows="4" cols="60"><?php gwpm_echo( $modelObj->gwpm_workplace_address ); ?></textarea></div>
						</div>
					<div class="form-group form-group-sm">
						<label class="col-sm-4 control-label">Designation:</label>
						<div class="col-sm-6"><input class="form-control"  type="text"  name="gwpm_work[designation]" id="gwpm_work[designation]"
							value="<?php gwpm_echo ( $modelObj->gwpm_work['designation'] ); ?>" maxLength="200" /></div>
					</div>
		</div>

		<div class="form-group form-group-sm">
			<div class="col-sm-8 col-sm-offset-4">
				<h4 class="text-muted">Family Information</h4>
			</div>
		</div>

			<div class="form-group form-group-sm required">
				<label class="col-sm-4 control-label">Native Place:</label>
				<div class="col-sm-6"><input class="form-control"  type="text"  name="gwpm_native_place" id="gwpm_native_place"
					value="<?php echo ( $modelObj->gwpm_native_place); ?>" maxLength="25" /></div>
			</div>
			<div class="form-group form-group-sm required">
				<label class="col-sm-4 control-label">Father's Name:</label>
				<div class="col-sm-6"><input class="form-control" maxLength="200"   type="text" name="gwpm_father_name" id="gwpm_father_name"
					value="<?php echo ( $modelObj->gwpm_father_name ); ?>" maxLength="25" /></div>
			</div>

			<div class="form-group form-group-sm">
				<label class="col-sm-4 control-label">Father's Occupation:</label>
				<div class="col-sm-6"><input class="form-control"  type="text" maxLength="300"  name="gwpm_father_occupation" id="gwpm_father_occupation"
					value="<?php echo ( $modelObj->gwpm_father_occupation ); ?>" maxLength="25" /></div>
			</div>
			<div class="form-group form-group-sm required">
				<label class="col-sm-4 control-label">Mother's Name:</label>
				<div class="col-sm-6"><input class="form-control"  type="text"  name="gwpm_mother_name" id="gwpm_mother_name"
					value="<?php echo ( $modelObj->gwpm_mother_name ); ?>" maxLength="25" /></div>
			</div>
			<div class="form-group form-group-sm">
				<label class="col-sm-4 control-label">Mother's Occupation:</label>
				<div class="col-sm-6"><input class="form-control" maxLength="300" type="text"  name="gwpm_mother_occupation" id="gwpm_mother_occupation"
					value="<?php echo ( $modelObj->gwpm_mother_occupation ); ?>" maxLength="25" /></div>
			</div>
			<div class="form-group form-group-sm">
				<label class="col-sm-4 control-label">Siblings:</label>
				<div class="col-sm-6"><textarea name="gwpm_siblings" id="gwpm_siblings" maxLength="200" rows="4" cols="60"><?php gwpm_echo( $modelObj->gwpm_siblings ); ?></textarea></div>
			</div>
			<div class="form-group form-group-sm required">
				<label class="col-sm-4 control-label">Family Contact No:</label>
				<div class="col-sm-6"><input class="form-control"  type="text" name="gwpm_contact_no" id="gwpm_contact_no"
					value="<?php gwpm_echo ( $modelObj->gwpm_contact_no ) ; ?>" maxLength="15" /></div>
			</div>
			<div class="form-group form-group-sm">
				<label class="col-sm-4 control-label">Mosal:</label>
				<div class="col-sm-6"><input class="form-control"  type="text"  name="gwpm_mosal" id="gwpm_mosal"
					value="<?php echo ( $modelObj->gwpm_mosal ); ?>" maxLength="100" /></div>
			</div>
			<div class="form-group form-group-sm">
				<label class="col-sm-4 control-label">Caste:</label>
				<div class="col-sm-6">
					<input class="form-control"  type="text"  disabled value="Kapol" />
					<p>This website is only for kapol members</p>
				</div>
	      	</div>
			<div class="form-group form-group-sm">
				<label class="col-sm-4 control-label">Family Address:</label>
				<div class="col-sm-6">
					<textarea name="gwpm_family_address" id="gwpm_family_address" maxLength="200" rows="4" cols="60"><?php gwpm_echo( $modelObj->gwpm_family_address ); ?></textarea>
				</div>
			</div>
			<div class="form-group form-group-sm">
				<label class="col-sm-4 control-label">Other Information:</label>
				<div class="col-sm-6">
					<input class="form-control"  type="text"  name="gwpm_other_info" id="gwpm_other_info"
					value="<?php echo ( $modelObj->gwpm_other_info ); ?>" maxLength="25" />
				</div>
			</div>
		<div class="form-group form-group-sm">
			<div class="col-sm-8 col-sm-offset-4">
				<h4 class="text-muted">Horoscope Information</h4>
			</div>
		</div>
`
		<div class="form-group form-group-sm required">
			<label class="col-sm-4 control-label">Date &amp; Time of Birth:</label>
			<div class="col-sm-6"><input class="form-control"  type="" data-field="" name="gwpm_dob" id="gwpm_dob"
				class="gwpm-datepicker" readonly="readonly"
				value="<?php gwpm_echo ( $modelObj->gwpm_dob ); ?>" maxLength="25" />
			</div>
		</div>

			<div class="form-group form-group-sm required">
				<label class="col-sm-4 control-label">Place of Birth:</label>
				<div class="col-sm-6"><input class="form-control" type="text"  name="gwpm_pob" id="gwpm_pob"
					value="<?php echo gwpm_echo ( $modelObj->gwpm_pob ); ?>" maxLength="25" /></div>
			</div>

			<div class="form-group form-group-sm required">
				<label class="col-sm-4 control-label">Gotra:</label>
				<div class="col-sm-6">
					<input class="form-control" type="text"  name="gwpm_gotra" id="gwpm_gotra" value="<?php echo gwpm_echo ( $modelObj->gwpm_gotra ); ?>" maxLength="25" />
				</div>
			</div>

			<div class="form-group form-group-sm required">
				<label class="col-sm-4 control-label">Marital Status:</label>
				<div class="col-sm-6">
					<?php $this->getSelectItem(getMaritalOptions(), 'gwpm_martial_status', ($modelObj->gwpm_martial_status)) ; 	?>
				</div>
			</div>

			<div class="form-group form-group-sm">
				<label class="col-sm-4 control-label">Horoscope Dosha:</label>
				<div class="col-sm-6">
					<?php $this->getSelectItem(getHoroscopeDoshaOptions(), 'gwpm_horoscope_dosha', ($modelObj->gwpm_horoscope_dosha)) ; 	?>
				</div>
			</div>

			<div class="form-group form-group-sm required">
				<label class="col-sm-4 control-label">Do You Believe in Horoscope matching:</label>
				<div class="col-sm-6">
					<?php $this->getSelectItem(getYesNoOptions(), 'gwpm_horoscope_matching', ($modelObj->gwpm_horoscope_matching)) ; 	?>
					 <br/>Check <a rel="nofollow" href="http://www.drikpanchang.com/jyotisha/horoscope-match/horoscope-match.html" target="_new">www.drikpanchang.com</a> for more details.
				</div>
			</div>

				<?php
					$dynaData = getDynamicFieldData() ;
					$totalDynamicFields = $dynaData['gwpm_dynamic_field_count'] ;
					$dyna_field_item = $dynaData['dyna_field_item'] ;
					if(sizeof($dyna_field_item) > 0) {
				?>
				<div class="form-group form-group-sm">
					<div class="col-sm-8 col-sm-offset-4">
						<h4 class="text-muted">Other Information</h4>
					</div>
				</div>
				<div>
					<table class='gwpm-table'>
						<tbody>
							<?php
							$keys = array_keys($dyna_field_item)  ;
							foreach ($keys as $vkey) {
								?>
									<tr>
										<td valign="top"><?php echo $dyna_field_item[$vkey]['label']  ?>:</td>
										<td valign="top">
											<?php
												 if($dyna_field_item[$vkey]['type'] == 'text') {
													gwpm_echo ('<input name="' . $vkey . '" id="' . $vkey . '" value="' .
																$modelObj-> $vkey . '" />' );
												 } else if($dyna_field_item[$vkey]['type'] == 'select') {
												 	$this->getSelectItem(getDynamicFieldOptions($dyna_field_item[$vkey]['value']), $vkey, $modelObj-> $vkey) ;
												 } else if($dyna_field_item[$vkey]['type'] == 'yes_no') {
												 	$this->getSelectItem(getYesNoOptions(), $vkey, $modelObj-> $vkey) ;
												 }
											?>
										</td>
									</tr>
								<?php
							}
							?>
						</tbody>
					</table>
				</div>
			<?php } ?>

		<div class="form-group form-group-sm required">
			<label class="col-sm-4 control-label">Profile Photo:</label>
			<div class="col-sm-4">
				 <input class="form-control" type="file" name="gwpm_profile_photo" id="gwpm_profile_photo" />
				 <span class="gwpm-help" >Image maximum size <b>1</b> mb </span>
			</div>
			<div class="col-sm-4">
				<a class="gwpm_profile_link" href="<?php echo $this->getUserImageURL ($modelObj->userId , $modelObj->gwpm_profile_photo['name'] ); ?>"
										target="_blank" title="Click to see the original image">
										<img class="gwpm-thumb-image" alt="profile-picture" src="<?php
										echo $this->getUserImageURL ($modelObj->userId , $modelObj->gwpm_profile_photo['thumb_name'] ); ?>" /></a>
			</div>
		</div>

		<div class="form-group">
		    <div class="col-sm-offset-4 col-sm-8">
		      <div class="checkbox">
		        <label>
		          <input type="checkbox"> By posting this, also agree to our Terms and Conditions.
		        </label>
		      </div>
		    </div>
		</div>

		<div class="form-group" id="validateMessages">
		</div>

		<div class="form-group">
			<div class="col-sm-6">
	    		<button class="btn btn-lg btn-success pull-right" type="submit" onclick="return validate()" value="Update" class="gwpm-button" name="update">Update</button>
			</div>
			<div class="col-sm-6">
				<button class="btn btn-lg btn-danger" type="button" value="Cancel" onClick="javascript:window.history.back();" class="gwpm-button" name="cancel">Cancel</button>
			</div>
		</div>
</form>

<div class="container">
	<div class="row">
		<div class="col-sm-12">
			<h4 class="text-muted">Terms &amp; Conditions</h4>
			<ol>
				<li>Poonakapol.com / poonakapol.org or Poona Kapol Mitra Mandal has not verified candidate data and Mandal is not responsible for any false data.</li>
				<li>If any candidate will get engaged, it is candidate's responsibility to inform to technical committee members.</li>
				<li>To delete the biodata website, Candidate has to send email to poonakapolmatrimonial@gmail.com from registered email id only.</li>
				<li>Candidate's biodata is open to all on the website. Anybody can view the candidate's biodata.</li>
				<li>By submitting / updating biodata on website, candidate is agreed to provide full access of his/her personal information to the viewer.</li>
				<li>Candidate's profile will be activated by Administrator within 4 to 5 days and you will be notified by email.</li>
				<li>Poonakapol.com is not bound to take permission for using candidate's photo for advertisment</li>
				<li>Any offensive content / information / photograph should not be updated / uploaded by any candidate.</li>
				<li>If it is found, legal action will be taken and will be considered as broken of cyber laws.</li>
			</ol>
		</div>
	</div>
	<div id="dtBox"></div>
</div>
<script type="text/javascript">
	 jQuery(document).ready(function($) {
		var today = new Date();
		var year = today.getFullYear() - 18 ;
		var month = today.getMonth() ;
		jQuery("#gwpm_dob").datetimepicker({
			ampm: true,
			changeYear: true,
			changeMonth: true,
			yearRange: '-70:-18'
		});
		jQuery("#gwpm_tmasvs_reg_date").datepicker({ dateFormat: 'MM d, yy', changeMonth: true, changeYear: true, firstDay: 0, monthNames: ['January','February','March','April','May','June','July','August','September','October','November','December'], monthNamesShort: ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sept','Oct','Nov','Dec'], dayNames: ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'], dayNamesShort: ['Sun','Mon','Tue','Wed','Thu','Fri','Sat'], dayNamesMin: ['Su','Mo','Tu','We','Th','Fr','Sa'], isRTL: false, minDate: '-100y', maxDate: '+5y', yearRange: '-100y:+5y' });
		//jQuery("#gwpm_accordion").accordion();//{ autoHeight: true, collapsible: true, active: -1,heightStyle: "content" });*/
		jQuery("select").change(function(obj){
			if(obj.currentTarget.id == "gwpm_education[qualification]" && obj.currentTarget.value == 7) {
				jQuery("#gwpm_education_other").removeClass("gwpm_hidden_fields");
				jQuery("#gwpm_education_other").val("") ;
			} else {
				jQuery("#gwpm_education_other").addClass("gwpm_hidden_fields");
				jQuery("#gwpm_education_other").val("none") ;
			}
		}) ;
	 });
	function validate()
	{
		jQuery("#validateMessages").html("<div class='row'><div class='col-sm-3'></div><div class='col-sm-6'><span class='gwpm-mandatory'>* - Mandatory Fields</span></div></div>");
		var msg="";
		var flag=true;
		if(jQuery("#gwpm_full_name").val().trim()=="") {
			msg = msg + "<br/>"+"Please enter your full name.";
			flag=false;
		}
		if(jQuery("#user_email").val().trim()=="") {
			msg = msg + "<br/>"+"Please enter your email.";
			flag=false;
		}
		if(jQuery("#gwpm_gender").val().trim()=="") {
			msg = msg + "<br/>"+"Please select your gender.";
			flag=false;
		}
		if(jQuery("#gwpm_resident_address").val().trim()=="") {
			msg = msg + "<br/>"+"Please enter your residental address.";
			flag=false;
		}
		if(jQuery("#gwpm_physical\\[height\\]").val().trim()=="") {
			msg = msg + "<br/>"+"Please enter height in centimeter.";
			flag=false;
		}
		if(jQuery("#gwpm_physical\\[weight\\]").val().trim()=="") {
			msg = msg + "<br/>"+"Please enter weight in kilograms.";
			flag=false;
		}
		if(jQuery("#gwpm_education\\[qualification\\]").val().trim()=="") {
			msg = msg + "<br/>"+"Please select qualification details.";
			flag=false;
		}
		if(jQuery("#gwpm_education\\[qualification\\]").val().trim()=="") {
			msg = msg + "<br/>"+"Please select qualification details.";
			flag=false;
		}
		else {
			if(jQuery("#gwpm_education_other").val().trim()=="") {
				msg = msg + "<br/>"+"Please select qualification details.";
				flag=false;
			}
		}
		if(jQuery("#gwpm_native_place").val().trim()=="") {
			msg = msg + "<br/>"+"Please enter native place.";
			flag=false;
		}
		if(jQuery("#gwpm_father_name").val().trim()=="") {
			msg = msg + "<br/>"+"Please your father's name.";
			flag=false;
		}
		if(jQuery("#gwpm_mother_name").val().trim()=="") {
			msg = msg + "<br/>"+"Please enter your mother's name.";
			flag=false;
		}
		if(jQuery("#gwpm_contact_no").val().trim()=="") {
			msg = msg + "<br/>"+"Please enter your family contact number(s).";
			flag=false;
		}
		if(jQuery("#gwpm_dob").val().trim()=="")
		{
			msg = msg + "<br/>"+"Please select your date of birth and time.";
			flag=false;
		}
		if(jQuery("#gwpm_gotra").val().trim()=="")
		{
			msg = msg + "<br/>"+"Please enter your gotra.";
			flag=false;
		}
		if(jQuery("#gwpm_martial_status").val().trim()=="")
		{
			msg = msg + "<br/>"+"Please select your marital status.";
			flag=false;
		}
		jQuery("#validateMessages").html("<div class='row'><div class='col-sm-3'></div><div class='col-sm-6'><span class='gwpm-mandatory'>* - Mandatory Fields<br>"+msg+"</span></div></div>");
		return flag;
	}
</script>
<!-- squirrel jQuery plugin -->
<script>
	!function(a,b,c,d){function e(b,c,d,e){var f=JSON.parse(b.getItem(c));if(null===f&&(f={}),j(e)||null===e)return j(f[d])?null:f[d];var g={};return g[d]=e,a.extend(f,g),b.setItem(c,JSON.stringify(f)),e}function f(a,b){a.removeItem(b)}function g(b){return"boolean"===a.type(b)}function h(b){return"object"===a.type(b)}function i(b){return"string"===a.type(b)&&b.trim().length>0}function j(a){return a===d}function k(a,b){return i(a)?a:b}a.fn.extend({squirrel:function(c,d){d=a.extend({},a.fn.squirrel.options,d);var l=null;if(i(d.storage_method)?l="LOCAL"===d.storage_method.toUpperCase()?b.localStorage:b.sessionStorage:null!==d.storage_method&&h(d.storage_method)&&(l=d.storage_method),null===l||!(h(l)&&"getItem"in l&&"removeItem"in l&&"setItem"in l))return this;c=i(c)&&/^(?:CLEAR|REMOVE|OFF|STOP)$/i.test(c)?c.toUpperCase():"START";var m="input[type!=file]:not(.squirrel-ignore), select:not(.squirrel-ignore), textarea:not(.squirrel-ignore)",n="button[type=reset], input[type=reset]",o="input[id], input[name], select[id], select[name], textarea[id], textarea[name]";return d.storage_key=k(d.storage_key,"squirrel"),d.storage_key_prefix=k(d.storage_key_prefix,""),this.each(function(){var b=a(this),h=b.attr("data-squirrel"),k=d.storage_key_prefix+(i(h)?h:d.storage_key);switch(c){case"CLEAR":case"REMOVE":f(l,k);break;case"OFF":case"STOP":b.find(m).off("blur.squirrel.js keyup.squirrel.js change.squirrel.js"),b.find(n).off("click.squirrel.js"),b.off("submit.squirrel.js");break;default:b.find("*").filter(o).each(function(){var c=a(this),d=c.attr("name");if(j(d)&&(d=c.attr("id"),j(d)))return b;var f=null;switch(this.tagName){case"INPUT":case"TEXTAREA":var g=c.attr("type");if("checkbox"===g){var h=c.attr("value");i(h)||(h=""),f=e(l,k,d+h),null!==f&&f!==this.checked&&(this.checked=f===!0,c.trigger("change"))}else"radio"===g?(f=e(l,k,d),null!==f&&f!==this.checked&&(this.checked=c.val()===f,c.trigger("change"))):(f=e(l,k,d),null!==f&&!c.is("[readonly]")&&c.is(":enabled")&&c.val()!==f&&c.val(f).trigger("change"));break;case"SELECT":f=e(l,k,d),null!==f&&a.each(a.isArray(f)?f:[f],function(b,d){c.find("option").filter(function(){var b=a(this);return b.val()===d||b.html()===d}).prop("selected",!0).trigger("change")})}}),b.find(m).on("blur.squirrel.js keyup.squirrel.js change.squirrel.js",function(){var b=a(this),c=b.attr("name");if(!j(c)||(c=b.attr("id"),!j(c))){var d=b.attr("value"),f="checkbox"!==this.type||j(d)?c:c+d;e(l,k,f,"checkbox"===this.type?b.prop("checked"):b.val())}}),b.find(n).on("click.squirrel.js",function(){f(l,k)}),b.on("submit.squirrel.js",function(){(!g(d.clear_on_submit)||d.clear_on_submit)&&f(l,k)})}})}}),a.fn.squirrel.options={clear_on_submit:!0,storage_method:"session",storage_key:"squirrel",storage_key_prefix:""},a(function(){a("form.squirrel, form[data-squirrel]").squirrel()})}(jQuery,window,document);
</script>