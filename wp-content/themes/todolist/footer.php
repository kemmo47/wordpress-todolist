<?php
    wp_footer();
?>

<script type="text/javascript">
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 1000,
        timerProgressBar: true,
    })

    function validate_todo(title) {
        if ( typeof title == 'number' ) {
            return title;
        }else{
            let rtn1 = title.replace("\A[[:space:]]*(.*)|[[:space:]]*\z/", "\\1");
            let rtn2 = rtn1.replace("\A[[\u3164]]*(.*)|[[\u3164]]*\z/", "\\1");
            let rtn3 = rtn2.replace("\A[[\ㅤ]]*(.*)|[[\ㅤ]]*\z/", "\\1");
            return rtn3;
        }
    }


    $("#request").on("submit", function(e){
        const _csrf = $('input[name="todo_csrf"]').val();
        const title = validate_todo($('input[name="post_title"]').val()).trim();

        if(!title || title.length === 0){
            Toast.fire({
                icon: 'error',
                title: `Khong duoc de trong`
            })
            e.preventDefault();
        } else {
            if(!_csrf){
                Toast.fire({
                    icon: 'error',
                    title: `Add in Unsuccessfully`
                })
            } else {
                $.ajax({
                    url: '/wp-content/themes/todolist/template-parts/add_todo_ajax.php',
                    type: "post",
                    dataType: 'json',
                    data: {title:title, _csrf:_csrf},
                    success:function(result){
                        window.location=document.location.href;
                    }
                });
            }
        }
    });

</script>

</body>
</html>
