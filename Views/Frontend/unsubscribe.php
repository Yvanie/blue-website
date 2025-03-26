<div class="cont">
    <div class="cont-header">
        <h1>Désabonnement</h1>
        <p><b>Accueil / Désabonnement</b></p>
    </div>
</div>

<div class="unsubscribe-content">
    <div class="unsubscribe-box">
        <div class="icon-container">
            <i class="fas fa-heart-broken"></i>
        </div>
        <div class="message">
            <?php if(isset($data['message'])): ?>
                <div class="alert alert-<?php echo $data['type']; ?>">
                    <?php echo $data['message']; ?>
                </div>
            <?php endif; ?>
            
            <?php if(isset($data['regret'])): ?>
                <div class="regret-message">
                    <?php echo $data['regret']; ?>
                </div>
                <div class="resubscribe-section">
                    <a href="index.php?p=home#newsletter" class="btn btn-primary">
                        <i class="fas fa-envelope"></i> Se réabonner
                    </a>
                </div>
            <?php endif; ?>
        </div>
        <div class="action-buttons">
            <a href="index.php?p=home" class="btn btn1">
                <i class="fas fa-home"></i> Retour à l'accueil
            </a>
        </div>
    </div>
</div> 