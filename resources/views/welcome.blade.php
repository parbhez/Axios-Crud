<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <title>Axios CRUD</title>
  </head>
  <body>
    
    <div class="container">
      <h1 class="text-center pt-5">Axios CRUD</h1>
        <div class="row mt-5">

         <div class="col-md-6">
            <div class="col">
               <div class="card text-left">
                 <div class="card-body">
                   <h4 class="card-title text-center">View Category</h4>
                   <div class="card-body">
                    <table>
                        <thead>
                            <th width="20%">Id</th>
                            <th width="20%">Category</th>
                            <th width="20%">Slug</th>
                            <th width="20%">Status</th>
                            <th width="20%">Action</th>
                        </thead>
                        <tbody id="tbody">
                            
                        </tbody>
                     </table>
                   </div>
                 </div>
               </div>
            </div>
         </div>

         <div class="col-md-6">
            <div class="col">
               <div class="card text-left">
                 <div class="card-body">
                   <h4 class="card-title text-center">Add Category</h4>
                  <div class="card-body">
                    <form id="formData">
                        <div class="mb-3">
                          <label for="exampleInputEmail1" class="form-label">Category</label>
                          <input type="text" id="category_name" class="form-control" id="exampleInputEmail1" placeholder="Category" aria-describedby="emailHelp">
                          <span id="category_name_error" class="text-danger"></span>
                        </div>

                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Slug</label>
                            <input type="text" id="slug" class="form-control" id="exampleInputEmail1" placeholder="Slug" aria-describedby="emailHelp">
                            <span id="slug_error" class="text-danger"></span>
                          </div>

                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Status</label><br>
                            
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="status" checked value="1">
                                <label class="form-check-label" for="inlineRadio1">Active</label>
                              </div>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="status"  value="0">
                                <label class="form-check-label" for="inlineRadio2">Inactive</label>
                              </div>
                              <span id="status_error" class="text-danger"></span>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                      </form>
                  </div>
                 </div>
               </div>
              </div>
         </div>

        </div>
      </div>


<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Category</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
                    <form id="editFormData">
                    <div class="modal-body">
         
                        <div class="mb-3">
                          <label for="exampleInputEmail1" class="form-label">Category</label>
                          <input type="text" id="edit_category_name" class="form-control" id="exampleInputEmail1" placeholder="Category" aria-describedby="emailHelp">
                          <span id="category_name_error" class="text-danger"></span>
                        </div>

                        <input type="hidden" id="edit_id">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Slug</label>
                            <input type="text" id="edit_slug" class="form-control" id="exampleInputEmail1" placeholder="Slug" aria-describedby="emailHelp">
                            <span id="slug_error" class="text-danger"></span>
                          </div>

                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Status</label><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input edit_status" type="radio" id="active_status" value="1">
                                <label class="form-check-label" for="inlineRadio1">Active</label>
                              </div>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input edit_status" type="radio" id="inactive_status" value="0">
                                <label class="form-check-label" for="inlineRadio2">Inactive</label>
                              </div>
                              <span id="status_error" class="text-danger"></span>
                        </div>
                  </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Update Category</button>
                </div>
            </form>
    </div>
  </div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>


      <script>
        //get base_url
        var base_url = window.location.origin
        // console.log(base_url);

        //Data reterive in category table
        function getAllCategories()
        {
          axios.get("{{ route('get-all-category') }}")
          .then(function(response){
            //console.log(response.data);
            table_data_row(response.data)
          })
          .catch(function(error){
            console.log(error);
          });
        }
        //function calling 
        getAllCategories();

        //show Table data in tbody
        function table_data_row(data)
        {
          var rows = '';
          var i = 1;
          if(data.length > 0) {
          $.each(data,function(index,value){
            rows = rows + '<tr>';
            rows = rows +  '<td width="20%">'+ i +'</td>';
            rows = rows + '<td width="20%">'+ value.category_name +'</td>';
            rows = rows + '<td width="20%">'+ value.slug +'</td>';
            rows = rows + '<td width="20%">'+ getStatusColor(value.status) +'</td>';
            rows = rows + '<td width="20%" class="text-center" data-id="'+value.id+'">';
            rows = rows + '<a class="btn btn-info btn-sm text-light" id="editRow" data-id="'+value.id+'" data-bs-toggle="modal" data-bs-target="#editModal">Edit</a>';
            rows = rows + '<a class="btn btn-danger btn-sm text-light" id="deleteRow" data-id="'+value.id+'">Delete</a>';
            rows = rows + '</td>';
            rows = rows + '</tr>';
            i++;
          });
        }else{
            rows = rows + '<tr>';
            rows = rows +  '<td colspan="10" class="text-center text-danger mt-5">Data Not Dound</td>';;
            rows = rows + '</tr>';
        }
          $("#tbody").html(rows);
          
        }

        //Status 
        function getStatusColor(status)
        {
          var html = "";
          if(status == 1){
            html = html + '<span class="badge bg-success">Active</span>';
          }else{
            html = html + '<span class="badge bg-danger">Inactive</span>';
          }
          return html;
        }

        //Data store in Category Table
        $(document).on('submit','#formData',function(e){
           e.preventDefault();

            axios.post("{{ route('save-category') }}", {
                category_name: $("#category_name").val(),
                slug: $("#slug").val(),
                status: $("#status").val(),
            })

            .then(function(response){
                getAllCategories(); //data create korar por success haoyar sate sate function ta call hobe. and cerated data ta table e show korbe.
                $("#category_name").val('');
                $("#slug").val('');
                $("#category_name_error").text('');
                $("#slug_error").text('');

                if(response.data.success == true){
                  Swal.fire({
                    icon: 'success',
                    title: 'Success...',
                    text: response.data.message,
                    })
                }else if(response.data.error == true){
                  Swal.fire({
                    icon: 'error',
                    title: 'Error...',
                    text: response.data.message,
                    })
                }
               //console.log(response.data.success);
               //console.log(response.data.message);
               //return false;
                
              })
            .catch(function(error){

                  if(error.response.data.errors.category_name){
                  $("#category_name_error").text(error.response.data.errors.category_name[0]);
                  }

                 if(error.response.data.errors.slug){
                  $("#slug_error").text(error.response.data.errors.slug[0]);
                 }

                 if(error.response.status == 500){
                  Swal.fire({
                    icon: 'error',
                    title: 'Error...',
                    text: "Internal Server Error",
                    })
                }

            });
            
       });

    //Delete Category 
    $(document).on('click','#deleteRow',function(e){
      e.preventDefault();
      var category_id = $(this).data('id');
      var delete_url = base_url + '/delete-category/'+category_id;
      //return console.log(delete_url);

      const swalWithBootstrapButtons = Swal.mixin({
          customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-danger'
          },
          buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Yes, delete it!',
          cancelButtonText: 'No, cancel!',
          reverseButtons: true
        }).then((result) => {
          if (result.isConfirmed) {
            getAllCategories(); //function calling when individual data deleted by id wise
            //delete url calling
            axios.get(delete_url)
            .then(function(response){
              getAllCategories();
             if(response.data.success == true){
                swalWithBootstrapButtons.fire(
                'Deleted!',
                 response.data.message,
                'success'
                )
             }
            });
          
          } else if (
            /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
          ) {
            swalWithBootstrapButtons.fire(
              'Cancelled',
              'Your Category data is safe !',
              'error'
            )
          }
        })
    });

    //Edit Category
    $(document).on('click','#editRow',function(e){
      var id = $(this).data('id');
      var edit_url = base_url+'/'+'edit-category'+'/'+id;
      //console.log(edit_url);
      axios.get(edit_url)
      .then(function(response){
        //console.log(response.data.status);
        $("#edit_category_name").val(response.data.category_name);
        $("#edit_slug").val(response.data.slug);
        $('#edit_id').val(response.data.id)
        if(response.data.status == 1){
          document.getElementById("active_status").checked = true;
        }else if(response.data.status == 0){
          document.getElementById("inactive_status").checked = true;
        }
      })
      .catch(function(error){
        // console.log(error);
        getAllCategories();
        Swal.fire({
                icon: 'error',
                title: 'Error...',
                text: "Something Went Wrong",
          })
      })
    });

    //Update Category 
    $(document).on('submit','#editFormData',function(e){
      e.preventDefault();
      let id = $("#edit_id").val();
      let data = {
        id: id,
        category_name: $("#edit_category_name").val(),
        slug: $("#edit_slug").val(),
        status: $(".edit_status").val()
      }
      var update_url = base_url+'/'+'update-category'+'/'+id;
      //console.log(data);
      axios.post(update_url,data)
      .then(function(response){
        //console.log(response.data);
        getAllCategories();
        $('#editModal').modal('toggle');
        if(response.data.success == true){
          Swal.fire({
                icon: 'success',
                title: 'Success...',
                text: response.data.message,
          })
        }else{
          Swal.fire({
                icon: 'error',
                title: 'Error...',
                text: response.data.message,
          })
        }
      })
      .catch(function(error){
        //console.log(error);
        getAllCategories();
        $('#editModal').modal('toggle');
        Swal.fire({
                icon: 'error',
                title: 'Error...',
                text: "Something Went Wrong",
          })
      });
    });
 </script>

  </body>
</html>