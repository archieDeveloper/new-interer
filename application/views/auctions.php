<?=$soc_html?>
<div class="wrap-auction">
    <h2>Аукцион</h2>
    <div class="wrap-auction-content">
        <?php foreach ($auctions as $cur_auction) : ?>
        <a href="/lot/<?=$cur_auction->id?>.html" class="auction-lot">
            <div class="img"><img src="/img/portfolio/0e2e631a.jpg"></div>
            <div class="lot-rigth">
                <div><h3><?=$cur_auction->title?></h3></div>
                <div class="lr-left">
                    <span><?php installer($cur_auction); ?></span>
                    <p><?=$cur_auction->descriptions?></p>
                </div>
                <div class="lr-rigth">
                    <span><b><?php time_before($cur_auction->date_time,$cur_auction->last_time); ?></b> до окончания</span><br>
                    <span class="lot-start-price"><b>начальная цена - </b><?php echo number_format($cur_auction->start_price, 0, '', ' '); ?> руб.</span>
                    <div class="button">Сделать ставку</div>
                </div>
            </div>
            <div class="cleaner"></div>
        </a>
    	<?php endforeach; ?>
        <div class="cleaner"></div>
    </div>
</div>