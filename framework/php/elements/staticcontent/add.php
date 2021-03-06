<?php if (!isset($_POST['doelementadd'])) { ?>
	<form name="staticcontent" method="post" action="" id="socialfeeds">
		<input type="hidden" name="doelementadd" value="makeitso" />
		<input type="hidden" name="element_type" value="staticcontent" />
		<h3>Element Details</h3>
		
		<label for="element_name">Name</label><br />
		<input type="text" id="element_name" name="element_name" placeholder="Give It A Name" /> 

		<div class="row_seperator">.</div><br />
		<div>
			<label>Content</label><br />
			<textarea id="element_content" name="element_content" class="tall"></textarea>
		</div>
		<div>
			<br />
			<input class="button" type="submit" value="Add That Element" />
		</div>

	</form>
		
<?php } else {
	
	$effective_user = AdminHelper::getPersistentData('cash_effective_user');

	$element_add_request = new CASHRequest(
		array(
			'cash_request_type' => 'element', 
			'cash_action' => 'addelement',
			'name' => $_POST['element_name'],
			'type' => $_POST['element_type'],
			'options_data' => array(
				'storedcotent' => $_POST['element_content'],
			),
			'user_id' => $effective_user
		)
	);
	if ($element_add_request->response['status_uid'] == 'element_addelement_200') {
	?>
	
		<h3>Success</h3>
		<p>
		Your new <b>Static Content</b> element is ready to go. To begin using it immediately insert
		this embed code on any page:
		</p>
		<code>
			&lt;?php CASHSystem::embedElement(<?php echo $element_add_request->response['payload']; ?>); // CASH element (<?php echo $_POST['element_name'] . ' / ' . $_POST['element_type']; ?>) ?&gt;
		</code>
		<br />
		<p>
		Enjoy!
		</p>

	<?php } else { ?>
		
		<h3>Error</h3>
		<p>
		There was a problem creating the element. <a href="./">Please try again.</a>
		</p>

<?php 
	}
}	
?>
