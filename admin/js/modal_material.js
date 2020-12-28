$(document).on("click", ".launch-modal", function () {
    var id = $(this).data('courseId');
    $(".modal-body #courseId").val( id );
    // As pointed out in comments, 
    // it is unnecessary to have to manually call the modal.
    // $('#addBookDialog').modal('show');
});

