<div class="indent"></div>
<div class="container">
    <h1 class="mt-4 mb-3"><?php echo $title; ?></h1>
    <div class="row">
        <div class="col-lg-8 mb-4">
            <form action="/account/profile" method="post">
                <div class="control-group form-group">
                    <div class="controls">
                        <label>Логин:</label>
                        <input type="text" class="form-control" value="<?php echo $_SESSION['account']['login']; ?>" disabled>
                        <p class="help-block"></p>
                    </div>
                    <?php if (empty($data)): ?>
                    <p>Вы еще не оставляли оценки</p>
                    <?php else: ?>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">id статьи</th>
                                <th scope="col">ваша оценка</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach($data as $val): ?>
                            <tr>
                                <td><?php echo $val['id_post']; ?></td>
                                <td><?php echo $val['rating']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                    <?php endif; ?>
                </div>
            </form>
        </div>
    </div>
</div>