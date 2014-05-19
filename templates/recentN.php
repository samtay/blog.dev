<div class="container">
    <div class="row">

		<?php for($i=0; $i<$this->N; $i++) { ?>
			<div class="col-md-<?php echo($this->colWidth); ?>">
				<a href="#"><img class="img-responsive img-circle" src="images/feat1.jpg"></a>
				<h3 class="text-center"><?php echo($this->data[$i]['title']); ?></h3>

				<p><?php echo($this->data[$i]['body']); ?></p>

				<a href="#" class="btn btn-success">Read More</a>
			</div>
		<?php } ?>

    </div>
</div>