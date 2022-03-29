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

    <title>Hello, world!</title>
  </head>
  <body>
    
    <div class="container">
        <div class="row mt-5">

         <div class="col-md-6">
            <div class="col">
               <div class="card text-left">
                 <div class="card-body">
                   <h4 class="card-title text-center">View Category</h4>
                   <div class="card-body">
                    <table>
                        <thead>
                            <th width="10%">Id</th>
                            <th width="40%">Category</th>
                            <th width="20%">Status</th>
                            <th width="30%">Action</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Mobile</td>
                                <td>Active</td>
                                <td>
                                    <a href="" class="btn btn-info btn-sm">Edit</a>
                                    <a href="" class="btn btn-danger btn-sm">Delete</a>
                                </td>
                            </tr>
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
                                <input class="form-check-input" type="radio" id="status" name="inlineRadioOptions" id="inlineRadio1" value="1">
                                <label class="form-check-label" for="inlineRadio1">Active</label>
                              </div>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="status" name="inlineRadioOptions" id="inlineRadio2" value="0">
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

      <script>
        $(document).on('submit','#formData',function(e){
            e.preventDefault();

            axios.post("{{ route('save-category') }}", {
                category_name: $("#category_name").val(),
                slug: $("#slug").val(),
                status: $("#status").val(),
            })

            .then(function(response){
                $("#category_name").val('');
                $("#slug").val('');
                $("#status").val('');
                $("#category_name_error").text('');
                $("#slug_error").text('');
                $("#status_error").text('');
                //console.log(response)
                Swal.fire({
                    icon: 'success',
                    title: 'Success...',
                    text: 'Category Save Successfully !!',
                    })
            })
            .catch(function(error){
                // console.log(error.response.data.errors);
                if(error.response.data.errors){
                    $("#category_name_error").text(error.response.data.errors.category_name[0]);
                    $("#slug_error").text(error.response.data.errors.slug[0]);
                    $("#status_error").text(error.response.data.errors.status[0]);
                }
               
            });
            
    });
      </script>

  </body>
</html>