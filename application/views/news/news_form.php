<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            body{
                padding: 15px;
            }
        </style>
    </head>
    <body>
        <h2 style="margin-top:0px">News <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">Title <?php echo form_error('title') ?></label>
            <input type="text" class="form-control" name="title" id="title" placeholder="Title" value="<?php echo $title; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Description <?php echo form_error('description') ?></label>
            <input type="text" class="form-control" name="description" id="description" placeholder="Description" value="<?php echo $description; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Author <?php echo form_error('author') ?></label>
            <input type="text" class="form-control" name="author" id="author" placeholder="Author" value="<?php echo $author; ?>" />
        </div>
	    <div class="form-group">
            <label for="timestamp">Created At <?php echo form_error('created_at') ?></label>
            <input type="text" class="form-control" name="created_at" id="created_at" placeholder="Created At" value="<?php echo $created_at; ?>" />
        </div>
	    <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('news') ?>" class="btn btn-default">Cancel</a>
	</form>
    </body>
</html>