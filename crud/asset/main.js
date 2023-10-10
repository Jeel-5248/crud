function deleteData(id) {
    if (confirm('You Want To Delete Product')) {
        var id = id;
        $.ajax({
            type: 'POST',
            url: 'index.php',
            data: {
                'action': 'delete_product',
                id: id
            },
            success: function (response) {
                console.log(response);
                location.reload();
            }
        })
    }
    else {
        txt = "You don't want to delete!";
    }
}

tinymce.init({
    selector: 'textarea',
    plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage tinycomments tableofcontents footnotes mergetags autocorrect typography inlinecss',
    toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
    tinycomments_mode: 'embedded',
    tinycomments_author: 'Author name',
    mergetags_list: [{
        value: 'First.Name',
        title: 'First Name'
    },
    {
        value: 'Email',
        title: 'Email'
    },
    ],
});