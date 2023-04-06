<?php if ( $_settings->check_flashdata( 'success' ) ) : ?>
<script>
	alert_toast("<?php echo $_settings->flashdata( 'success' ); ?>", "success");
</script>
<?php endif; ?>
<div class="container-fluid">
	<div class="content bg-warning py-3 px-4">
		<h3 class="fw-bolder text-light">Order</h3>
	</div>
	<div class="row mt-n4 justify-content-center">
		<div class="col-md-11">
		<div class="card rounded-0">
			<div class="card-body">
				<form action="" id="sales-form">
					<input type="hidden" name="total_amount">
					<div class="pos-feild d-flex flex-column flex-md-row flex-column-reverse flex-row-reverse">
						<div class="menu-list col-md-8">
							<fieldset>
								<legend>Categories</legend>
								<div class="cat-list d-flex overflow-auto pb-1">
									<?php
										$sql      = 'SELECT * FROM category_list WHERE status = 1 AND delete_flag = 0 ORDER BY NAME ASC';
										$category = mysqli_query( $conn, $sql );
										$cat_id   = '';
									while ( $row = mysqli_fetch_assoc( $category ) ) :
										if ( empty( $cat_id ) ) {
											$cat_id .= $row['id'];
										}
										?>
									<button onclick="return false;" class="cat_btn col-8 col-sm-6 col-md-4 col-lg-3 btn btn-default btn-xs rounded-pill mx-3 py-1 px-2 fs-6 border <?php echo isset( $cat_id ) && $cat_id == $row['id'] ? 'bg-gradient-warning text-light' : 'bg-gradient-light'; ?>" data-id="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></button>
									<?php endwhile; ?>
								</div>
							</fieldset>
							<fieldset>
								<legend>Menu</legend>
								<div class="item-list">
									<div class="row d-flex overflow-auto">
										<?php
											$menu        = 'SELECT * FROM menu_list WHERE status = 1 AND delete_flag = 0 ORDER BY name ASC';
											$menu_result = mysqli_query( $conn, $menu );
										while ( $row = mysqli_fetch_assoc( $menu_result ) ) :
											?>
										<div class="col-8 col-sm-6 col-md-5 col-lg-5 mb-3 menu-item <?php echo isset( $cat_id ) && $cat_id == $row['category_id'] ? '' : 'd-none'; ?>" cat-data-id="<?php echo $row['category_id']; ?>">
											<button type="button" class="btn btn-block btn-default btn-xs rounded-pill mx-3 py-1 px-5 fs-6 border bg-gradient-light item-btn" data-id="<?php echo $row['id']; ?>" data-price="<?php echo $row['price']; ?>"><?php echo $row['code'] . ' - ' . $row['name']; ?></button>
										</div>
										<?php endwhile; ?>
									</div>
								</div>
							</fieldset>
							<div class="text-center">
								<button class="btn rounded-pill px-4 border bg-gradient-warning">Place order</button>
							</div>
						</div>
						<div class="col-md-4 bg-gradient-dark">
							<h4 class=" fs-4"><b>Orders</b></h4>
							<div class="order-items-holder bg-gradient-light mb-3">
								<div class="order-details text-center d-flex bg-gradient-warning">
									<div class="col-3 fw-bold mb-0 border">QTY</div>
									<div class="col-6 fw-bold mb-0 border">Menu</div>
									<div class="col-3 fw-bold mb-0 border">Total</div>
								</div>
								<div class="order-items-body">
								</div>
							</div>
						   <div class="order-items-footer">
							<div class="d-flex">
									<h3 class="col-7 ">Grand Total</h3>
									<h3 class="col-5  bg-gradient-light text-right" id="grand-total">0.00</h3>
								</div>
								<div class="d-flex">
									<h3 class="col-7">Trendered</h3>
									<h3 class="col-5 bg-gradient-light text-right px-0"><input type="number" name="tendered_amount" min="0" step="any" class="form-control rounded-0 text-right bg-gradient-light fw-bolder" style="font-size:1em" required value="0"></h3>
								</div>
								<div class="d-flex">
									<h3 class="col-7">Change</h3>
									<h3 class="col-5 bg-gradient-light text-right" id="change">0.00</h3>
								</div>
						   </div>
						</div>
					</div>
				</form>
			</div>
		</div>
		</div>
	</div>
</div>
<noscript>
	<div class="product-item text-center d-flex bg-gradient-light">
		<input type="hidden" name="menu_id[]" value="">
		<input type="hidden" name="price[]" value="">
		<div class="input-group m-1">
			<button class="btn btn-xs btn-warning minus-qty" type="button"><i class="fa-solid fa-minus"></i></button>
			<input type="number" class="form-control text-center qty" name="quantity[]" min="1" value="1" readonly>
			<button class="btn btn-xs btn-warning plus-qty" type="button"><i class="fa-solid fa-plus"></i></button>
		</div>
		<div class="col-6 mb-0 py-0 px-1 border">
			<div class="text-sm" style="line-height: 1rem;">
				<div class="d-flex align-items-center">
					<a href="javascript:void(0)" class="btn btn-xs border-0 d-inline remove-item"><i class="fa-solid fa-xmark" style="color: #e00000;"></i></a>
					<p class="fw-bold my-0 ms-1 menu-name">D1 - Coke 12oz</p>
				</div>
				<div class="text-left text-muted">
					<span class="menu-price">x 25.00</span>
				</div>
			</div>
		</div>
		<div class="col-3 mb-0 py-2 fw-bolder text-right border menu-total">25.00</div>
	</div>
</noscript>
<script>

	function calc_total(){
		var gt = 0;
		$(".order-items-body .product-item").each(function(){
			var total = 0;
			var price = $(this).find('input[name="price[]"]').val();
				price = price > 0 ? price : 0;
			var qty = $(this).find('input[name="quantity[]"]').val();
				qty = qty > 0 ? qty : 0;
				total = parseFloat(price) * parseFloat(qty);
				gt += parseFloat(total);
				$(this).find('.menu-total').text(total);
		})
		$()
		$('input[name="total_amount"]').val(gt).trigger('change');
		$("#grand-total").text(gt);
	}

	$(document).ready(function(){
		$(".cat_btn").click(function(){
			$(".cat_btn.bg-gradient-warning").removeClass("bg-gradient-warning text-light").addClass("bg-gradient-light");
			$(this).removeClass("bg-gradient-light").addClass("bg-gradient-warning text-light");
			var id = $(this).attr('data-id');
			$('.menu-item').addClass('d-none');
			$(".menu-item[cat-data-id='"+id+"']").removeClass("d-none");

		})

		$(".item-btn").click(function(){
			var id = $(this).attr('data-id');
			var price = $(this).attr('data-price');
			var name = $(this).text().trim();
			var item = $($("noscript").html()).clone();

			if($(".order-items-body .product-item[data-id='"+id+"']").length > 0){
				var item = $(".order-items-body .product-item[data-id='"+id+"']");
				var qty = item.find('input[name="quantity[]"]').val();
				qty = qty > 0 ? qty : 0;
				qty = parseInt(qty) + 1;
				item.find('input[name="quantity[]"]').val(qty);
				calc_total();
				return false;
			}
			
			
			item.attr('data-id', id);
			item.find('input[name="menu_id[]"]').val(id);
			item.find('input[name="price[]"]').val(price);
			item.find('.menu-name').text(name);
			item.find('.menu-price').text(price);
			item.find('.menu-total').text(price);
			
			$('.order-items-body').append(item);
			calc_total();


			item.find('.minus-qty').click(function(){
				var qty = item.find('input[name="quantity[]"]').val();
				qty = qty > 0 ? qty : 0;
				qty = qty == 1 ? 1 : parseInt(qty) - 1;
				item.find('input[name="quantity[]"]').val(qty);
				calc_total();
			})
			item.find('.plus-qty').click(function(){
				var qty = item.find('input[name="quantity[]"]').val();
				qty = qty > 0 ? qty : 0;
				qty = parseInt(qty) + 1;
				item.find('input[name="quantity[]"]').val(qty);
				calc_total();
			})
			item.find('.remove-item').click(function(){
				if(confirm('Are you sure to remove this item from list?') == true) {
					item.remove();
					calc_total();
				}
			})
		})
		$("input[name='tendered_amount'], input[name='total_amount']").on('input change',function(){
			var total = $('input[name="total_amount"]').val();
			var tendered = $("input[name='tendered_amount']").val();
				total = total > 0 ? total : 0;
				tendered = tendered > 0 ? tendered : 0;
			var change = parseFloat(tendered) - parseFloat(total);
			$("#change").text(change);

		})
		$("#sales-form").submit(function(e){
			e.preventDefault();
			if($(".order-items-body .product-item").length <= 0){
				alert_toast("Please Add atleast 1 Item First.", "warning");
				return false;
			}
			if(parseFloat($("input[name='tendered_amount']").val()) < parseFloat($("input[name='total_amount']").val())){
				alert_toast("Invalid tendered amount.", "error");
				return false;
			}
			start_loader();
			$.ajax({
				url: _base_url_ + "classes/Master.php?f=place_order",
				method: "POST",
				data:$(this).serialize(),
				error: err =>{
					console.log(err);
					alert("Error");
				},
				success: function(resp){
					if(resp){
						resp = JSON.parse(resp);
						if(resp.status == "success"){
							setTimeout(() => {
								var new_window = window.open(_base_url_ + "admin/sale/receipt.php?id="+resp.oid, "_blank", "width="+($(window).width() * .8) +",left="+($(window).width() * .1)+",height="+($(window).height() * .8)+",top="+($(window).height() * .1));
								setTimeout(() => {
									new_window.print();
									setTimeout(() => {
										new_window.close();
										location.reload();
										end_loader();
									}, 500);
								}, 200);
							}, 200);
						}else if(resp.status == "failed"){
							console.log('failed');
						}else{
							console.log(resp);
						}
					}
				}
			})
		})
	})
</script>
<!-- <script>

	function calc_total(){
		var gt = 0;
		$(".order-items-body .product-item").each(function(){
			var total = 0;
			var price = $(this).find('input[name="price[]"]').val();
				price = price > 0 ? price : 0;
			var qty = $(this).find('input[name="quantity[]"]').val();
				qty = qty > 0 ? qty : 0;
				total = parseFloat(price) * parseFloat(qty);
				gt += parseFloat(total);
				$(this).find('.menu-total').text(total);
		})
	}

	$(document).ready(function(){
		$(".cat_btn").click(function(){
			$(".cat_btn.bg-gradient-warning").removeClass("bg-gradient-warning text-light").addClass("bg-gradient-light");
			$(this).removeClass("bg-gradient-light").addClass("bg-gradient-warning text-light");
			var id = $(this).attr('data-id');
			$('.menu-item').addClass('d-none');
			$(".menu-item[cat-data-id='"+id+"']").removeClass("d-none");

		})

		$(".item-btn").click(function(){
			var id = $(this).attr('data-id');
			var price = $(this).attr('data-price');
			var name = $(this).text().trim();
			var item = $($("noscript").html()).clone();

			if($(".order-items-body .product-item[data-id='"+id+"']").length > 0){
				var item = $(".order-items-body .product-item[data-id='"+id+"']");
				var qty = item.find('input[name="quantity[]"]').val();
				qty = qty > 0 ? qty : 0;
				qty = parseInt(qty) + 1;
				item.find('input[name="quantity[]"]').val(qty);
				calc_total();
				return false;
			}
			
			
			item.attr('data-id', id);
			item.find('input[name="menu_id[]"]').val(id);
			item.find('input[name="price[]"]').val(price);
			item.find('.menu-name').text(name);
			item.find('.menu-price').text(price);
			item.find('.menu-total-price').text(price);
			
			$('.order-items-body').append(item);
			calc_total();


			item.find('.minus-qty').click(function(){
				var qty = item.find('input[name="quantity[]"]').val();
				qty = qty > 0 ? qty : 0;
				qty = qty == 1 ? 1 : parseInt(qty) - 1;
				item.find('input[name="quantity[]"]').val(qty);
				calc_total();
			})
			item.find('.plus-qty').click(function(){
				var qty = item.find('input[name="quantity[]"]').val();
				qty = qty > 0 ? qty : 0;
				qty = parseInt(qty) + 1;
				item.find('input[name="quantity[]"]').val(qty);
				calc_total();
			})
		})
	})
</script> -->
