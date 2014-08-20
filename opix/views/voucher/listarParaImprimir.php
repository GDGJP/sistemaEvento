<style>

@media print{
  .bg {
    background: white url(http://www.anid.com.br/7encontro/img/voucher650.png) no-repeat top left !important;
    height: 450px !important;
  }
.voucher {
    padding-top: 225px !important;
}
.desconto {
    padding: 35px 0 0 215px !important;
    font-size: 18px !important;
}
  hr {
    page-break-after: always;
  }

</style>
			
			<?php if(!empty($listaDeVouchers)) : ?>
				
						<?php 
              $count=0;
							foreach($listaDeVouchers AS $voucher) :
						?>
				    <?php echo $voucher->html; ?>
            <?php 
              if($count==1) { 
                $count=0;
            ?>
            <hr />
            <?php } else {
            $count++;            
            } ?>
						<?php
							endforeach;
						?>

			<?php endif; ?>

