<style type="text/css">
    /* Theme Setup Vars */
    :root {
        --bday-primary: #9b90e0;
        --bday-primary-light: #f4f2fc;
        --bday-border: #ece9f9;
        --bday-text-dark: #2d2b42;
        --bday-text-muted: #8b87a3;
        --bday-shadow: 0 4px 20px rgba(155, 144, 224, 0.08);
        --radius-main: 16px;
    }

    /* Container Box Base styling */
    .bday-panel-card {
        background: #ffffff;
        border: 1px solid var(--bday-border);
        border-radius: var(--radius-main);
        box-shadow: var(--bday-shadow);
        padding: 30px;
        margin-bottom: 30px;
    }

    /* Section Subheadings */
    .bday-section-title {
        color: var(--bday-text-dark);
        font-size: 16px;
        font-weight: 700;
        margin-top: 25px;
        margin-bottom: 15px;
        padding-bottom: 8px;
        border-bottom: 2px solid var(--bday-primary-light);
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .bday-section-title:first-of-type {
        margin-top: 0;
    }
    .bday-section-title i {
        color: var(--bday-primary);
    }

    /* User Birthday Row Row Matrix */
    .bday-user-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 12px 16px;
        background: #ffffff;
        border: 1px solid var(--bday-border);
        border-radius: 12px;
        margin-bottom: 10px;
        transition: all 0.2s ease;
    }
    .bday-user-row:hover {
        background-color: var(--bday-primary-light);
        border-color: var(--bday-primary);
        transform: translateY(-1px);
    }

    /* Left side info block alignment */
    .bday-user-meta {
        display: flex;
        align-items: center;
        gap: 14px;
    }
    .bday-avatar {
        width: 42px;
        height: 42px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid var(--bday-primary-light);
    }
    .bday-username {
        font-size: 14px;
        font-weight: 600;
        color: var(--bday-text-dark);
        text-decoration: none !important;
    }

    /* Right Side date badges */
    .bday-date-badge {
        display: inline-block;
        padding: 4px 12px;
        border-radius: 20px;
        background-color: var(--bday-primary-light);
        color: var(--bday-primary);
        font-weight: 700;
        font-size: 12px;
        letter-spacing: 0.5px;
    }

    /* Empty states fallback configuration */
    .bday-empty-state {
        background: var(--bday-primary-light);
        border: 1px dashed var(--bday-primary);
        border-radius: 12px;
        padding: 20px;
        text-align: center;
        margin-bottom: 15px;
    }
    .bday-empty-state h4 {
        margin: 0;
        color: var(--bday-text-muted);
        font-size: 14px;
        font-weight: 500;
    }
</style>

<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <div class="bday-panel-card">

            <!-- 1. BIRTHDAYS TODAY -->
            <h3 class="bday-section-title">
                <i class="fa fa-birthday-cake" aria-hidden="true"></i> Anniversaires aujourd'hui
            </h3>
            
            <?php $auj = 0; ?>
            <?php foreach($users as $user): ?>
                <?php if(date("m-d") == date("m-d", strtotime($user["User"]["date_de_naissance"]))): $auj++; ?>
                    <div class="bday-user-row">
                        <div class="bday-user-meta">
                            <?php echo $this->Html->image("ann.gif", array("class" => "bday-avatar", "alt" => "Avatar")); ?>
                            <a href="#" class="bday-username"><?php echo h($user["User"]["name"]); ?></a>
                        </div>
                        <div>
                            <span class="bday-date-badge"><i class="fa fa-gift"></i> Aujourd'hui</span>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>

            <?php if($auj == 0): ?>
                <div class="bday-empty-state">
                    <h4>Aucun anniversaire aujourd'hui</h4>
                </div>
            <?php endif; ?>


            <!-- 2. RECENT BIRTHDAYS -->
            <h3 class="bday-section-title">
                <i class="fa fa-history" aria-hidden="true"></i> Anniversaires récents
            </h3>
            
            <?php $rec = 0; ?>
            <?php foreach($users as $user): ?>
                <?php if(date("m-d") > date("m-d", strtotime($user["User"]["date_de_naissance"]))): $rec++; ?>
                    <div class="bday-user-row">
                        <div class="bday-user-meta">
                            <?php echo $this->Html->image("ann.gif", array("class" => "bday-avatar", "alt" => "Avatar")); ?>
                            <a href="#" class="bday-username"><?php echo h($user["User"]["name"]); ?></a>
                        </div>
                        <div>
                            <span class="bday-date-badge" style="background-color: #f7f7f9; color: var(--bday-text-muted);">
                                <?php echo date("d-m", strtotime($user["User"]["date_de_naissance"])); ?>
                            </span>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>

            <?php if($rec == 0): ?>
                <div class="bday-empty-state">
                    <h4>Aucun anniversaire récent</h4>
                </div>
            <?php endif; ?>


            <!-- 3. UPCOMING BIRTHDAYS -->
            <h3 class="bday-section-title">
                <i class="fa fa-calendar-check-o" aria-hidden="true"></i> Anniversaires à venir
            </h3>
            
            <?php $ven = 0; ?>
            <?php foreach($users as $user): ?>
                <?php if(date("m-d") < date("m-d", strtotime($user["User"]["date_de_naissance"]))): $ven++; ?>
                    <div class="bday-user-row">
                        <div class="bday-user-meta">
                            <?php echo $this->Html->image("ann.gif", array("class" => "bday-avatar", "alt" => "Avatar")); ?>
                            <a href="#" class="bday-username"><?php echo h($user["User"]["name"]); ?></a>
                        </div>
                        <div>
                            <span class="bday-date-badge">
                                <?php echo date("d-m", strtotime($user["User"]["date_de_naissance"])); ?>
                            </span>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>

            <?php if($ven == 0): ?>
                <div class="bday-empty-state">
                    <h4>Aucun anniversaire à venir</h4>
                </div>
            <?php endif; ?>

        </div>
    </div>
    <div class="col-md-2"></div>
</div>