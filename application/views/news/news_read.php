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
        <h2 style="margin-top:0px">News Read</h2>
        <table class="table">
	    <tr><td>Title</td><td><?php echo $title; ?></td></tr>
	    <tr><td>Description</td><td><?php echo $description; ?></td></tr>
	    <tr><td>Author</td><td><?php echo $author; ?></td></tr>
	    <tr><td>Created At</td><td><?php echo $created_at; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('news') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>