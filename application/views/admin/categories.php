<div class="row">
    <div class="col-md-3">
        <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Thêm Thể Loại</h3>
            </div><!-- /.box-header -->
            <!-- form start -->
            <form role="form">
                <div class="box-body">
                    <div class="form-group">
                        <label for="tag-name">Tên Thể Loại</label>
                        <input class="form-control" id="tag-name" type="text">
                    </div>
                    <div class="form-group">
                        <label for="slug">Slug</label>
                        <input class="form-control" id="slug" type="text">
                    </div>
                    <div class="form-group">
                        <label>Cha</label>
                        <select class="form-control">
                            <option>option 1</option>
                            <option>option 2</option>
                            <option>option 3</option>
                            <option>option 4</option>
                            <option>option 5</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Mô Tả</label>
                        <textarea class="form-control" rows="3" placeholder="Enter ..."></textarea>
                    </div>
                </div><!-- /.box-body -->
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Thêm</button>
                </div>
            </form>
        </div><!-- /.box -->
    </div>

    <div class="col-md-9">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Danh Sách Bài Viết</h3>
                <div class="box-tools">
                    <div class="input-group" style="width: 150px;">
                        <input name="table_search" class="form-control input-sm pull-right" placeholder="Search" type="text">
                        <div class="input-group-btn">
                            <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </div>
            </div><!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <tbody>
                        <tr>
                            <th>Tên</th>
                            <th>Mô Tả</th>
                            <th>Slug</th>
                            <th>Số Lượng</th>
                        </tr>
                        <tr>
                            <td>hoclaptrinh</td>
                            <td>Bài viết về lập trình</td>
                            <td>hoclaptrinh</td>
                            <td>13</td>
                        </tr>
                    </tbody>
                </table>
            </div><!-- /.box-body -->
            <div class="box-footer clearfix">
                <ul class="pagination pagination-sm no-margin pull-right">
                    <li><a href="#">«</a></li>
                    <li><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">»</a></li>
                </ul>
            </div>
        </div><!-- /.box -->
    </div>
</div>