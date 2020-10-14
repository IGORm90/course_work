<header class="masthead" style="background-image: url('/public/materials/<?php echo $data['id']; ?>.jpg')">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <div class="page-heading">
                    <h1><?php echo htmlspecialchars($data['name'], ENT_QUOTES); ?></h1>
                    <span class="subheading"><?php echo htmlspecialchars($data['description'], ENT_QUOTES); ?></span>
                </div>
            </div>
        </div>
    </div>
</header>
<div class="container">
    <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            <p><?php echo htmlspecialchars($data['text'], ENT_QUOTES); ?></p>
        </div>
    </div>
    <div class="rating-form">
    <?php if (isset($_SESSION['account']['id']) and $canDoRate): ?>
    <form id="rate" action="/account/rating" method="post">
    <div class="rating-area">
    <p class="rate-lab">Поставить оценку:</p>
	    <input type="radio" id="star-5" name="rating" value="5">
	    <label for="star-5" title="Оценка «5»"></label>	
	    <input type="radio" id="star-4" name="rating" value="4">
	    <label for="star-4" title="Оценка «4»"></label>    
	    <input type="radio" id="star-3" name="rating" value="3">
	    <label for="star-3" title="Оценка «3»"></label>  
	    <input type="radio" id="star-2" name="rating" value="2">
	    <label for="star-2" title="Оценка «2»"></label>    
	    <input type="radio" id="star-1" name="rating" value="1">
        <label for="star-1" title="Оценка «1»"></label>
    <button id="btn-rate" type="button" class="btn btn-primary">submit</button>
    </div>
    </form>
    <?php endif; ?>
    <div id="errorMess"></div>   
    </div>
    <script src="/public/scripts/rating.js"></script>
</div>
