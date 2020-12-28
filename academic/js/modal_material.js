$(document).on("click", ".launch-modal", function () {
    var id = $(this).data('id');
    var title = $(this).data('title');
    var location = $(this).data('location');
    $(".modal-body #materialTitle").val( title );
    $(".modal-body #materialLocation").val( location );
    $(".modal-body #materialId").val( id );
    // As pointed out in comments, 
    // it is unnecessary to have to manually call the modal.
    // $('#addBookDialog').modal('show');
});

