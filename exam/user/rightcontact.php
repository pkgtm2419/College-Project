<section class="span8 ">
		<div class="col-right">
			
			<hr>
			<h4>General Enquiry or Apply</h4>
            
			<div id="message-contact"></div>
			<form method="post" action="http://www.ansonika.com/edu/assets/contact.php" id="contactform">
				<div class="row">
					<div class="span3">
						<label>Name <span class="required">* </span></label>
						<input type="text" class="span3 ie7-margin" id="name_contact">
					</div>
					<div class="span3">
						<label>Last name <span class="required">* </span></label>
						<input type="text" class="span3 ie7-margin" id="lastname_contact">
					</div>
				</div>
				<div class="row">
					<div class="span3">
						<label>Email <span class="required">* </span></label>
						<input type="email" id="email_contact" class="span3 ie7-margin">
					</div>
					<div class="span3">
						<label>Phone <span class="required">* </span></label>
						<input type="text" id="phone_contact" class="span3 ie7-margin">
					</div>
				</div>
				<div class="row">
					<div class="span3">
						<label>Select a department</label>
						<select id="subject_contact" class="span3">
							<option value="Administration">Administration</option>
							<option value="Admissions">Admissions</option>
							<option value="Courses">Courses</option>
							<option value="Apply">Apply</option>
						</select>
					</div>
				</div>
                <div class="row">
					<div class="span3">
						<label>Message <span class="required">*</span></label>
						<textarea rows="5" id="message_contact" class="span6"></textarea>
					</div>
				</div>
				<div class="row">
					<div class="span3">
						<label><span class="required">*</span> Are you human? 3 + 1 =</label>
						<input type="text" id="verify_contact" class="span2">
					</div>
					<div class="button-align span3">
						<input type="submit" id="submit-contact" value="Submit" class=" button_medium">
					</div>
				</div>
				<hr>
			</form>
            
			<h4>Plan a visit</h4>
			<div id="message-visit"></div>
			<form method="post" action="http://www.ansonika.com/edu/assets/visit.php" id="visit">
				<div class="row">
					<div class="span3">
						<label>Name <span class="required">* </span></label>
						<input type="text" class="span3 ie7-margin" id="name_visit">
					</div>
					<div class="span3">
						<label>Last name <span class="required">* </span></label>
						<input type="text" class="span3 ie7-margin" id="lastname_visit">
					</div>
				</div>
				<div class="row">
					<div class="span3">
						<label>Email <span class="required">* </span></label>
						<input type="email" id="email_visit" class="span3 ie7-margin">
					</div>
					<div class="span3">
						<label>Phone <span class="required">* </span></label>
						<input type="text" id="phone_visit" class="span3 ie7-margin">
					</div>
				</div>
				<div class="row">
					<div class="span3">
						<div id="datetimepicker" class="input-append">
							<label>Select a date <span class="required">* </span></label>
							<input type="text" class=" dateinput" id="date_visit" readonly>
							<span class="add-on"><i data-time-icon="icon-time" data-date-icon="icon-calendar"></i></span>
						</div>
					</div>
					<div class="span3">
						<label><span class="required">*</span> Are you human? 3 + 1 =</label>
						<input type="text" id="verify_visit" class="span2">
					</div>
				</div>
				<!-- end row-->
				<input type="submit" id="submit-visit" value="Submit" class=" button_medium">
			</form>
            
		</div><!-- end col right-->
		</section>