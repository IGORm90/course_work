<header class="masthead" style="background-image: url('/public/images/home-bg.jpg')">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
               <div class="site-heading">
                     <!--<h1>It блог</h1>
                    <span class="subheading">блог на it тематику</span>-->
                </div>
            </div>
        </div>
    </div>
</header>
<div class="container-fluid" style="width: 80%;">
    <div class="row">       
        <div class="col-xl-8 col-md-8 col-lg-8">
            <?php if (empty($list)): ?>
                <p>Список постов пуст</p>
            <?php else: ?>
                <?php foreach ($list as $val): ?>
                    <div class="post-preview">
                        <a href="/post/<?php echo $val['id']; ?>">
                            <h2 class="post-title"><?php echo htmlspecialchars($val['name'], ENT_QUOTES); ?></h2>
                            <h5 class="post-subtitle"><?php echo htmlspecialchars($val['description'], ENT_QUOTES); ?></h5>
                        </a>
                        <p class="post-meta">Дата и время добавления: <?php echo $val['dt']; ?></p>
                        <?php if ($val['count_rate'] > 0): ?>
                            <p class="post-meta">Средняя оценка: <?php echo round($val['sum_value']/$val['count_rate'],1); ?></p>
                        <?php endif; ?>
                    </div>
                    <hr>
                <?php endforeach; ?>
                <div class="clearfix">
                    <?php echo $pagination; ?>
                </div>
            <?php endif; ?>
        </div>

    <div class="col-xl-4 col-md-4 col-lg-4">
    <h3>Рекомендации</h2>
    <?php if (empty($recomend)): ?>
        <p>Список рекомедаций пуст</p>
    <?php else: ?>
    <?php foreach ($recomend as $rec): ?>
    <div class="card">
        <div class="card-body">
        <h5 class="card-title"><?php echo htmlspecialchars($rec['name'], ENT_QUOTES); ?></h5>
        <p class="card-text"><?php echo htmlspecialchars($rec['description'], ENT_QUOTES); ?></p>
        <a href="/post/<?php echo $rec['id']; ?>" class="btn btn-primary">Читать</a>
        </div>
    </div>
    <?php endforeach; ?>
    <?php endif; ?>
    </div>
</div>
</div>