

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">

<section class="content p-3">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border py-3">
                    <a class="add-new" href="{{ Route('createCategory') }}">
                        <button class="btn btn-primary btn-xs">Add New Category</button>
                    </a>
                </div>
                @if (\Session::has('delete'))
                    <li class="alert alert-danger">{!! \Session::get('delete') !!}</li>
                @endif
                <div class="box-body">
                    <table class="table table-bordered table-striped py-3" id="table">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Category Name</th>
                                <th class="text-center">Category Slug</th>
                                <th class="text-center">Parent Category</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($categories))
                                <?php $_SESSION['i'] = 0; ?>
                                @foreach ($categories as $category)
                                    <?php $_SESSION['i'] = $_SESSION['i'] + 1; ?>
                                    <tr>
                                        <?php $dash = ''; ?>
                                        <td>{{ $_SESSION['i'] }}</td>
                                        <td>{{ $category->name }}</td>
                                        <td>{{ $category->slug }}</td>
                                        <td>
                                            @if (isset($category->parent_id))
                                                {{ $category->subcategory->name }}
                                            @else
                                                None
                                            @endif

                                        </td>
                                        <td>
                                            <a href="{{ Route('editCategory', $category->id) }}">
                                                <button class="btn btn-info">Edit</button>
                                            </a>
                                            <a href="{{ Route('deleteCategory', $category->id) }}">
                                                <button class="btn btn-danger">Delete</button>
                                            </a>
                                        </td>
                                    </tr>

                                    @if (count($category->subcategory))
                                        @include('sub-category-list', [
                                            'subcategories' => $category->subcategory,
                                        ])
                                    @endif
                                @endforeach
                                <?php unset($_SESSION['i']); ?>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="//code.jquery.com/jquery-1.12.3.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
<script>
    $(document).ready(function() {
        $('#table').DataTable();
    });
</script>
