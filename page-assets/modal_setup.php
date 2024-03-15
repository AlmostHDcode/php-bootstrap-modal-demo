<!-- Modal js functions -->
<script>
function show_datamodal(title, url) {
    $('.pace-inactive').remove(); //stops pace from creating duplicate divs
    if($("#datamodal")) {
        $("#datamodal").remove(); //delete modal div if it already exists
    }

    //modal html
    let datamodal_string = `<div class='modal fade' id='datamodal' role='dialog'>
                                <div class='modal-dialog modal-md' role='document'>
                                    <div class='modal-content'>
                                        <div class='modal-header'>
                                            <h5 class='modal-title'></h5>
                                        </div>
                                        <div class='modal-body'>
                                        </div>
                                        <div class='modal-footer'>
                                            <button type="button" class="btn btn-primary" id='datamodal-submit' onclick="$('#datamodal form').submit()">Save</button>
                                            <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>`;
    $('#MyModalsDiv').append(datamodal_string); //add the html to MyModalsDiv
    //get the data to be put into the modal
    $.ajax({
        url: url,
        error: err => {
            console.log('show_data_modal error occured');
        },
        success: function(resp) {
            if (resp) {
                $('#datamodal .modal-title').html(title);
                $('#datamodal .modal-body').html(resp);
                const datamodal = new bootstrap.Modal('#datamodal', {
                    backdrop: 'static',
                    keyboard: false,
                    focus: true
                }).show();
            }
        }
    });
}

function show_pdf_modal(src) {
    $('.pace-inactive').remove(); //stops pace from creating duplicate divs
    if($("#pdf_modal")) {
        $("#pdf_modal").remove(); //delete modal div if it already exists
    }

    let pdf_modal_string = `<div class='modal fade' id='pdf_modal' role='dialog'>
	                            <div class='modal-dialog modal-xl modal-dialog-tall' role='document'>
		                            <div class='modal-content modal-dialog-tall'>
			                            <button type='button' class='btn-close' data-bs-dismiss='modal' style='display:block;font-size:20pt;text-align:center;margin:auto'><span class='fa fa-times'></span></button>
		                            </div>
	                            </div>
                            </div>`;
    $('#MyModalsDiv').append(pdf_modal_string);

    let iframe_string = $("<iframe style='height:90%;' src='" + src + "'></iframe>");
    $('#pdf_modal .modal-content').prepend(iframe_string);
    const pdf_modal = new bootstrap.Modal('#pdf_modal', {
        keyboard: false,
        focus: true
    }).show();
}
</script>