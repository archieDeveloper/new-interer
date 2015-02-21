<?=$soc_html?>
<?php foreach ($current_lot as $cur_auction) : ?>
<h2 class="mb20"><?=$cur_auction->title?></h2>
<div class="lot-img">
    <div class="big-img"><img src="/img/portfolio/0e2e631a.jpg"></div>
    <div class="min-img">
        <img src="/img/portfolio/0e2e631a.jpg" alt="">
        <img src="/img/portfolio/0e2e631a.jpg" alt="">
        <img src="/img/portfolio/0e2e631a.jpg" alt="">
    </div>
</div>
<div class="lot-rigth-view">
    <?php show_tf($set_rate, '<span id="status-rate">ставка принята<div class="close-status-rate">x</div></span>', 'ставка должна быть больше, чем сейчас'); ?>
    <div>
        <span class="lr-price-design">Дизайнер - <?=$cur_auction->design?><br><?php echo number_format($cur_auction->rate, 0, '', ' '); ?> руб. <b>- Текущая цена</b></span>
        <span class="lr-last-time"><b><?php time_before($cur_auction->date_time,$cur_auction->last_time); ?></b> до окончания<br><span class="lot-start-price"><b>начальная цена -</b> <?php echo number_format($cur_auction->start_price, 0, '', ' '); ?> руб.</span>
        </span>
        <div class="cleaner"></div>
    </div>
    <div class="lr-form-rate">
    <?php if ($is_auth) : ?>
        <form action="" method="post">
            <label for="rate">
                <span class="lr-rates">Сделано ставок: <b><?php echo $user_lot->num_rows; ?></b> <?php show_tf($user_lot->num_rows, '<a href="#" id="open_history_rate">История ставок</a>'); ?><br>лидирует <b><?php installer($cur_auction); ?><br></b></span><br><br><br>
                Ваша ставка: <input type="text" id="rate" name="rate" value="<?=$cur_auction->rate?>"> руб.<br>
                Повысить на: <a href="#" class="button plus-rate">+ <span>10</span> руб.</a><a href="#" class="button plus-rate">+ <span>100</span> руб.</a><a href="#" class="button plus-rate">+ <span>1000</span> руб.</a>
    <div class="cleaner"></div>
            </label>
            <button class="buttom" name="send_rate">Сделать ставку</button>
            <div class="cleaner"></div>
        </form>
    <?php else : ?>
        <a href="#">Участвовать в аукционе могут только зарегистрированные пользователи</a>
    <?php endif; ?>
    </div>
    <div class="cleaner"></div>
</div>
<div class="tabs-lot">
    <ul>
        <li><a href="#tabs-1">Описание</a></li>
        <li ><a href="#tabs-2">История ставок</a></li>
        <div class="cleaner"></div>
    </ul>
    <div id="tabs-1" class="tab-item">
        <?=$cur_auction->descriptions?>
    </div>
    <div id="tabs-2" class="tab-item">
        <table class="history-rates" cols="4" align="center" width="100%" cellspacing="0">
            <tbody>
                <tr class="hr-title">
                    <th scope="col">№</th>
                    <th scope="col">Пользователь</th>
                    <th scope="col">Ставка</th>
                    <th scope="col">Дата</th>
                </tr>
                <?php $i = 0; foreach ($user_lot->result() as $history_lot) : ?>
                <tr>
                    <td><?php echo $user_lot->num_rows-$i; $i++; ?></td>
                    <td><?php echo $history_lot->first_name.' '.$history_lot->last_name; ?></th>
                    <td><?php echo number_format($history_lot->user_rate, 0, '', ' '); ?> Руб.</th>
                    <td><?php echo date_rus(explode(' ', $history_lot->date_time)[0]); ?> в <?php echo explode(' ', $history_lot->date_time)[1] ?></th>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
   </div>
</div>
<?php endforeach; ?>
<div class="cleaner"></div>