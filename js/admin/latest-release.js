var table;
var BASE_URL = $("#hidBASE_URL").val();
var ADMIN_CONTROLLER = $("#hidAdminController").val();

var CSRF_TOCKEN = $("#csrf-token").attr("content"); // FOR CSRF for every ajax request.
var CSRF_NAME = $("#csrf-name").attr("content"); // FOR CSRF for every ajax request.

/////////////////////// CHANGE THESE URLS  FOR AJAX //////////////////////////////////////////////////////////////////////////////

function syncQuillFieldsAndRun(callback) {
	const quillFields = document.querySelectorAll(".js-quill");
	quillFields.forEach((field) => {
		const quillInstance = Quill.find(field);
		if (quillInstance) {
			field.value = quillInstance.root.innerHTML;
		}
	});
	callback();
}

var save_method; // for save method string

$(document).ready(function () {
	//=================================================================================================================================

	$.widget.bridge("uibutton", $.ui.button);

	//datatables
	table = $("#dataTable").DataTable({
		processing: true,
		serverSide: true,
		ordering: true,
		searching: true,
		order: [],
		ajax: {
			url: BASE_URL + "index.php/" + ADMIN_CONTROLLER + "/releaseList",
			type: "POST",
			data: { li_token: CSRF_TOCKEN },
		},
		columnDefs: [
			{
				targets: [-1],
				orderable: false,
			},
		],
	});

	//datepicker
	$(".datepicker").datepicker({
		autoclose: true,
		format: "dd/mm/yyyy",
		todayHighlight: true,
		orientation: "top auto",
		todayBtn: true,
		todayHighlight: true,
	});

	// $('#example1').DataTable({});
});

function addData() {
	save_method = "add";
	$("#btnSave").text("Save"); //change button text
	$("#btnSave").removeAttr("disabled"); //set button disable
	$("#form")[0].reset(); // reset form on modals
	$(".form-group").removeClass("has-error"); // clear error class
	$(".help-block").empty(); // clear error string
	$("#modal_form").modal("show"); // show bootstrap modal
	$(".modal-title").text("Add New"); // Set Title to Bootstrap modal title

	//showing image upload area when add data.
	$("#hideWhenEdit").show();

	$("#divError").hide();
	$("#divMessage").hide();
	$("#hidID").val("0");

	if (typeof setQuillText === "function") {
		setQuillText("Details", "");
	}
}
function addImg() {
	save_method = "add";
	$("#btnSave").text("Save"); //change button text
	$("#btnSave").removeAttr("disabled"); //set button disable
	//$('#form')[0].reset(); // reset form on modals
	$(".form-group").removeClass("has-error"); // clear error class
	$(".help-block").empty(); // clear error string
	$("#modal_form1").modal("show"); // show bootstrap modal
	$(".modal-title").text("Add Image"); // Set Title to Bootstrap modal title

	//showing image upload area when add data.
	$("#hideWhenEdit").show();

	$("#divError").hide();
	$("#divMessage").hide();
	$("#hidID").val("0");
}

function editData(id) {
	var EDIT_URL =
		$("#hidBASE_URL").val() +
		"index.php/" +
		ADMIN_CONTROLLER +
		"/getEditRelease";

	save_method = "add";
	$("#form")[0].reset(); // reset form on modals
	$(".form-group").removeClass("has-error"); // clear error class
	$(".help-block").empty(); // clear error string

	// hiding image upload area when editing data.
	$("#hideWhenEdit").hide();

	$("#divError").hide();
	$("#divMessage").hide();

	//Ajax Load data from ajax
	$.ajax({
		url: EDIT_URL + "/" + id,
		type: "GET",
		dataType: "JSON",
		success: function (data) {
			$('[name="id"]').val(data.Id);
			$('[name="hidID"]').val(data.Id);

			$('[name="Film_Name"]').val(data.FilmName);
			$('[name="Language"]').val(data.Language);
			$('[name="Category"]').val(data.Category);
			$('[name="Details"]').val(data.Details);
			if (typeof setQuillText === "function") {
				setQuillText("Details", data.Details || "");
			}
			$('[name="By_Line"]').val(data.By_Line);
			$('[name="DateCreated"]').val(data.DateCreated);
			$('[name="Place"]').val(data.Place);
			$('[name="UniqueName"]').val(data.UniqueName);
			//$('[name="userfile"]').val(data.Photo);
			// $('[name="Password"]').val("xxxxxxxxxxxxxx");
			// $('[name="Retype_Password"]').val("xxxxxxxxxxxxxx");
			$('[name="Count_Title"]').val(data.countTitle);
			//$('[name="Sex"]').val(data.Sex);
			$('[name="Status"]').val(data.Status);
			//$('[name="userfile"]').val(data.Image);
			$("#modal_form").modal("show"); // show bootstrap modal when complete loaded
			$(".modal-title").text("Edit Movies"); // Set title to Bootstrap modal title
		},
		error: function (jqXHR, textStatus, errorThrown) {
			alert("Error get data from ajax");
		},
	});
}

function reloadTable() {
	table.ajax.reload(null, false); //reload datatable ajax
}

function syncDetailsFieldFromQuill() {
	var detailsField = document.getElementById("Details");
	if (!detailsField) {
		return;
	}

	var quill =
		window.quillInstances && window.quillInstances.Details
			? window.quillInstances.Details
			: null;

	if (!quill && typeof createQuillInstance === "function") {
		quill = createQuillInstance("Details");
	}

	if (!quill || !quill.root) {
		return;
	}

	var html = quill.root.innerHTML || "";
	if (typeof getQuillHtmlValue === "function") {
		html = getQuillHtmlValue(quill);
	} else if (html === "<p><br></p>") {
		html = "";
	}

	detailsField.value = html;
}

function save() {
	syncDetailsFieldFromQuill();
	if (typeof syncQuillFieldsAndRun === "function") {
		syncQuillFieldsAndRun(function () {});
		syncDetailsFieldFromQuill();
	}

	//------------------------------- VALIDATION START -----

	var formUtils = {
		isValidEmail: function (email) {
			var regex =
				/^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
			return regex.test(email);
		},
		//if no form errors, remove or hide error messages
		clearErrors: function () {
			$("#emailAlert").remove();
			$("#form .help-block").hide();
			$("#form .form-group").removeClass("has-error");
		},
		//upon form clear remove the checked class and replace with unchecked class. Also reset Google ReCaptcha
		clearForm: function () {
			$("#form .glyphicon")
				.removeClass("glyphicon-check")
				.addClass("glyphicon-unchecked")
				.css({ color: "" });
			$("#form input,textarea").val("");
		},
		//when error, show error messages and track that error exists
		addError: function ($input) {
			var parentFormGroup = $input.parents(".form-group");
			parentFormGroup.children(".help-block").show();
			parentFormGroup.addClass("has-error");
		},
		addAjaxMessage: function (msg, isError) {
			$("#btnSave").after(
				'<div id="emailAlert" class="alert alert-' +
					(isError ? "danger" : "success") +
					'" style="margin-top: 5px;">' +
					$("<div/>").text(msg).html() +
					"</div>",
			);
		},
	};

	var url;
	var base_url;
	var adminController;

	var $btn = $(this);
	$btn.val("Saving");
	formUtils.clearErrors();

	var repass = false;
	//do a little client-side validation -- check that each field has a value and e-mail field is in proper format
	//use custom validation so Quill-backed textareas are handled correctly
	//do a little client-side validation
	//do a little client-side validation
	var $form = $("#form"),
		hasErrors = false;

	$("#form input:visible, #form textarea:visible, #form select:visible")
		.not(".optional")
		.each(function () {
			var $this = $(this);

			if (($this.is(":checkbox") && !$this.is(":checked")) || !$this.val()) {
				hasErrors = true;
				formUtils.addError($(this));
			}

			//------ validating comboboxes -----

			var $userGroup = $("#User_Group");
			var $sex = $("#Sex");

			if ($userGroup.length && $userGroup.val() == "") {
				hasErrors = true;
				formUtils.addError($userGroup.parent());
			}

			if ($sex.length && $sex.val() == "") {
				hasErrors = true;
				formUtils.addError($sex.parent());
			}

			// matching password fields

			var $password = $("#Password");
			var $rePassword = $("#Retype_Password");

			if (
				$password.length &&
				$rePassword.length &&
				$password.val() != $rePassword.val()
			) {
				repass = true;
				formUtils.addError($rePassword.parent());
			}
		});

	// ADD THIS BLOCK HERE ↓↓↓

	var detailsVal = $.trim($("#Details").val());
	var detailsText = $.trim($("<div>").html(detailsVal).text());
	var hasDetailsMedia = /<(img|iframe|video|embed)\b/i.test(detailsVal);

	if (!detailsText && !hasDetailsMedia) {
		hasErrors = true;
		formUtils.addError($("#Details"));

		var detailsErrorMsg =
			'<button style="color:white;" type="button" class="close" aria-hidden="true" onclick="$(\'.alert\').hide()"> &times; </button>';

		detailsErrorMsg +=
			'<strong style="color:white;">Error ! Details field is required.</strong>';

		$("#divError").show();
		$("#divError").html(detailsErrorMsg);

		return false;
	}

	// EXISTING CODE CONTINUES ↓↓↓

	if (hasErrors) {
		var errorMsg =
			'<button style="color:white;" type="button" class="close"  aria-hidden="true" onclick="$(\'.alert\').hide()"> &times; </button>';

		errorMsg +=
			'<strong style="color:white;">Error ! Missing required fields.</strong>';

		$("#divError").show();
		$("#divError").html(errorMsg);

		return false;
	}

	//---------------------- Repass checking --->
	if (repass) {
		var errorMsg =
			'<button style="color:white;" type="button" class="close"  aria-hidden="true" onclick="$(\'.alert\').hide()"> &times; </button>';
		errorMsg +=
			'<strong style="color:white;">Error ! Miss matching password and retype password fields.</strong>';
		$("#divError").show();
		$("#divError").html(errorMsg);
		$btn.val("reset");

		// error msg alert closing in 2 sec.
		$("#divError")
			.fadeTo(2000, 500)
			.slideUp(500, function () {
				$(".alert").hide();
			});

		return false;
	}

	$(".alert").hide(); // hiding all the message alert.
	$("#btnSave").text("Saving..."); //change button text
	$("#btnSave").attr("disabled", true); //set button disable

	if (save_method == "add") {
		base_url = $("#hidBASE_URL").val(); // for delete after saving .
		adminController = $("#hidAdminController").val();

		url =
			$("#hidBASE_URL").val() +
			"index.php/" +
			ADMIN_CONTROLLER +
			"/saveRelease";
	}

	// ajax adding data to database
	// FormData is using for ajax file uploading.

	if (typeof FormData == "undefined") {
		bootbox.alert(
			"Oops,Your Browser Don't support FormData API! Use IE 10 or Above!",
		);
		return false;
	}

	var formData = new FormData($("#form")[0]);
	var fileField = _("userfile"); // getting the file field object.

	//formData.append('User_Id', $("#User_Id").val());

	//checking file are a is hidden or not. this is only for add data.

	/*if($("#hideWhenEdit").is(":visible")) 
            formData.append('userfile', fileField.files[0]); 
    
            //formData.append('userfile', $("#userfile").val());
       
         formData.append('User_Group', $("#User_Group").val());
         formData.append('Password', $("#Password").val()); // ####
         formData.append('Sex', $("#Sex").val());
         formData.append('Status', $("#Status").val());
         formData.append('hidID', $("#hidID").val()); // for save or edit.
		 formData.append('li_token', CSRF_TOCKEN);
         
    */

	// alert(formData);
	//return;
	$.ajax({
		url: url,
		type: "POST",
		//data: $('#form').serialize(),
		data: formData,
		dataType: "text",
		processData: false,
		contentType: false,
		cache: false,
		enctype: "multipart/form-data",
		success: function (res) {
			//console.log(res);
			//return;
			if (res.indexOf("Exists") >= 0) {
				var errorMsg =
					'<button style="color:white;" type="button" class="close"  aria-hidden="true" onclick="$(\'.alert\').hide()"> &times; </button>';
				errorMsg +=
					'<strong style="color:white;">Error ! This Film Name or Unique Name already exists.</strong>';

				$("#divError").show();
				$("#divError").html(errorMsg);
				$btn.val("reset");

				reloadTable();
				$("#hidBASE_URL").val(base_url); // for delete after load table.
				$("#hidAdminController").val(adminController);
				$("#upload-file-info").html(""); //clearing the file.
				$("#btnSave").text("Save"); //change button text
				$("#btnSave").attr("disabled", false); //set button enable

				return false;
			}

			// if error
			if (res.indexOf("Error") >= 0) {
				var errorMsg =
					'<button style="color:white;" type="button" class="close"  aria-hidden="true" onclick="$(\'.alert\').hide()"> &times; </button>';
				errorMsg += '<strong style="color:white;">' + res + "</strong>";

				$("#divError").show();
				$("#divError").html(errorMsg);
				$btn.val("reset");

				reloadTable();
				$("#hidBASE_URL").val(base_url); // for delete after load table.
				$("#hidAdminController").val(adminController);
				$("#upload-file-info").html(""); //clearing the file.
				$("#btnSave").text("Save"); //change button text
				$("#btnSave").attr("disabled", false); //set button enable

				return false;
			}

			var saveOrEdit = "saved";
			var EDIT_ID = $("#hidID").val();
			if (EDIT_ID > 0) var saveOrEdit = "edited";

			var msg =
				'<button style="color:white;" type="button" class="close"  aria-hidden="true" onclick="$(\'.alert\').hide()"> &times; </button>';
			msg +=
				'<strong style="color:white;">Success! Data has been ' +
				saveOrEdit +
				" successfully!.</strong>";
			$("#divMessage").html(msg);
			$("#divMessage").show();

			// For message alert closing in 2 sec.
			$("#divMessage")
				.fadeTo(2000, 500)
				.slideUp(500, function () {
					$(".alert").hide();
					//$("#form")[0].reset(); // reseting form
				});
			$btn.val("Save");
			if (EDIT_ID == 0) formUtils.clearForm();

			//$('#modal_form').modal('hide');
			reloadTable();
			$("#hidBASE_URL").val(base_url); // for delete after load table.
			$("#hidAdminController").val(adminController);
			$("#upload-file-info").html(""); //clearing the file.
			$("#btnSave").text("Save"); //change button text
			$("#btnSave").attr("disabled", false); //set button enable
		},
		error: function (jqXHR, textStatus, errorThrown) {
			var errorMsg =
				'<button style="color:white;" type="button" class="close"  aria-hidden="true" onclick="$(\'.alert\').hide()"> &times; </button>';
			errorMsg +=
				'<strong style="color:white;">Error ! Error while saving data.</strong>';

			$("#divError").show();
			$("#divError").html(errorMsg);

			// For message alert closing in 2 sec.
			$("#divError")
				.fadeTo(2000, 500)
				.slideUp(500, function () {
					$("#divError").hide();
				});

			$("#btnSave").text("Save"); //change button text
			$("#btnSave").attr("disabled", false); //set button enable
		},
	});
}

function deleteData(id) {
	bootbox.confirm({
		message: "Are you Sure to Delete this Data?",
		buttons: {
			confirm: {
				label: "Yes",
				className: "btn-success",
			},
			cancel: {
				label: "No",
				className: "btn-danger",
			},
		},
		callback: function (result) {
			if (result == false) return;
			// ajax delete data to database
			$.ajax({
				url:
					$("#hidBASE_URL").val() +
					"index.php/" +
					ADMIN_CONTROLLER +
					"/deleteRelease/" +
					id,
				type: "POST",
				dataType: "text",
				data: { li_token: $("#csrf-token").attr("content") },
				success: function (res) {
					if (res.indexOf("Details exists") >= 0) {
						var errorMsg =
							'<span style="color:red; font-weight:bold;">Sorry Can\'t delete this data, details exists.<span>';
						bootbox.alert(errorMsg);
						return false;
					}

					if (res.indexOf("Error") >= 0) {
						var errorMsg =
							'<span style="color:red; font-weight:bold;">' + res + "<span>";
						bootbox.alert(errorMsg);
						return false;
					}

					reloadTable();
				},
				error: function (jqXHR, textStatus, errorThrown) {
					bootbox.alert("Error deleting data");
				},
			});
		},
	}); // bootbox confirm ending
}
/*function viewData(id)
{
	window.location.replace("view");
}
*/
