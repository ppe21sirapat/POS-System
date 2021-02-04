$(document).ready(function()
{   
    $('#table-product-manage').DataTable() ;

// <-- DELETE
    $('#table-product-manage').on("click",".delete-btn",function()
    {
       var delete_id = $(this).attr("id") ;

        Swal.fire({
                    title: 'Are you sure?',
                    text: "to delete this product ",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                 }).then((result) => {
                        if (result.isConfirmed) 
                        {   
                            $.ajax
                            ({
                                method:"POST",
                                url:"manage_product_sql.php",
                                data: {
                                        action:"delete",
                                        id:delete_id
                                      }
                            })
                            Swal.fire(
                                        'Deleted!',
                                        'Your product has been deleted.',
                                        'error'
                                     )
                            setTimeout(function()
                            {
                                location.reload();
                            },2500 );
                        }
                    })             
    } );
// DELETE -->

// <-- ADD

    $('#addproduct-btn').click(function()
    {
        $('.add-box').animate
        ({
            top:'0px' 
        },400);
        $('.add-window').css("display","block") ;
    } );

    $('.add-close-btn').click(function(){
        $('.add-box').animate
        ({
           top:'-300px' 
        },400);
        setTimeout(function()
        {
            $('.add-window').css("display","none") ;
        },350);
    } );

    $('.cancel-btn').click(function(){
        $('.add-box').animate
        ({
            top:'-300px'
        },400);
        setTimeout(function()
        {
            $('.add-window').css("display","none") ;
        },350);
    } );

    $('.confirm-btn').click(function()
    {
        var fd = new FormData() ;
        var add_image = $('#add-image')[0].files ;
        var add_name = $('#add-product-name').val() ;
        var add_price = $('#add-product-price').val() ;
        var add_type = $('#add-product-type').val() ;

        fd.append('action',"add") ;
        fd.append('file',add_image[0]) ;
        fd.append('name',add_name) ;
        fd.append('price',add_price) ;
        fd.append('type',add_type) ;

        $.ajax
        ({
            method:"POST",
            url:"manage_product_sql.php",
            data: fd,
            contentType: false,
            processData: false,
            success: function(response)
                    {
                        const Toast = Swal.mixin
                        ({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            didOpen: (toast) => 
                            {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        })

                        Toast.fire
                        ({
                            icon: 'success',
                            title: 'Product has been added'
                        })
                        $('#add-window').css("display","none") ;
                        setTimeout(function()
                        {
                            location.reload(); 
                        }, 4000);
                    }
        })
    } );

//ADD -->

// <-- EDIT
    $('#table-product-manage').on("click",".edit-btn",function()
    {
        var edit_id = $(this).attr("id") ;

        $.ajax
        ({
            method:"POST",
            url:"edit_data.php",
            data: {
                    id:edit_id
                  },
            dataType: "json",
            success:function(edit_data)
                { 
                    $('.edit-box').css("top","-300px") ;
                    $('.edit-box').animate
                    ({
                        top:'0px' 
                    },400);
                    $('#edit-id').val(edit_data.id) ;
                    $('#ex-image').val(edit_data.product_img) ;
                    $('#edit-product-name').val(edit_data.product_name) ;
                    $('#edit-product-price').val(edit_data.product_price) ;
                    $('#edit-window').css("display","block") ;
                }
        })
    } );

    $('.edit-close-btn').click(function()
    {
        $('.edit-box').animate
        ({
            top:'-300px'
        },400);
        setTimeout(function()
        {
            $('#edit-window').css("display","none") ;
        },350);
    } );

    $('#dontsave-btn').click(function()
    {
        $('.edit-box').animate
        ({
            top:'-300px'
        },400);
        setTimeout(function()
        {
            $('#edit-window').css("display","none") ;  
        },350);
    } );

    $('#save-btn').click(function()
    {
        var edit_form = new FormData() ;
        var edit_id = $('#edit-id').val() ;
        var edit_image = $('#edit-image')[0].files ;
        var edit_name = $('#edit-product-name').val() ;
        var edit_price = $('#edit-product-price').val() ;
        var edit_type = $('#edit-product-type').val() ;
        var ex_image = $('#ex-image').val() ;

            edit_form.append('action',"edit") ;
            edit_form.append('id',edit_id) ;
            edit_form.append('file',edit_image[0]) ;
            edit_form.append('name',edit_name) ;
            edit_form.append('price',edit_price) ;
            edit_form.append('type',edit_type) ;
            edit_form.append('ex-image',ex_image) ;
        
        $.ajax
        ({
            method:"POST",
            url:"manage_product_sql.php",
            data: edit_form,
            contentType: false,
            processData: false,
            success: function(response)
                    {
                        const Toast = Swal.mixin
                        ({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            didOpen: (toast) =>
                            {
                                toast.addEventListener('mouseenter', Swal.setTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        })
                        Toast.fire
                        ({
                            icon: 'success',
                            title: 'Product has been edited'
                        })

                        $('#edit-window').css("display","none") ;
                        setTimeout(function()
                        {
                            location.reload();
                        },4000); 

                    }
        })


        // var edit_id  = $('#edit-id').val() ;
        // var edit_name = $('#edit-product-name').val() ;
        // var edit_price = $('#edit-product-price').val() ;
        // var edit_type = $('#edit-product-type').val() ;

        // $.ajax
        // ({
        //     method:"POST",
        //     url:"manage_product_sql.php",
        //     data: {
        //             action:"edit",
        //             id:edit_id,
        //             name:edit_name,
        //             price:edit_price,
        //             type:edit_type
        //           },
        //     success:function(data)
        //           { 
        //             const Toast = Swal.mixin
        //             ({
        //                 toast: true,
        //                 position: 'top-end',
        //                 showConfirmButton: false,
        //                 timer: 3000,
        //                 timerProgressBar: true,
        //                 didOpen: (toast) => 
        //                 {
        //                     toast.addEventListener('mouseenter', Swal.stopTimer)
        //                     toast.addEventListener('mouseleave', Swal.resumeTimer)
        //                 }
        //             })

        //             Toast.fire
        //             ({
        //                 icon: 'success',
        //                 title: 'Product has been edited'
        //             })
        //             $('#edit-window').css("display","none") ;

        //             setTimeout(function()
        //             {
        //                 location.reload(); 
        //             }, 4000);   
        //           }
        // })
    } );
// EDIT -->

} );