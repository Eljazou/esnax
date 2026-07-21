<!-- Replace jQuery UI with Flatpickr -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/fr.js"></script>

<style>
    .part_jour_group {
        display: none;
    }
</style>

<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title" style="padding-left: 0px;margin-left: -7px;"> <?php echo 'Demande d\'absence'; ?></h3>
    </div>
    <div class="panel-body">
        <div class="col-lg-6">
            <div class="panel panel-primary">
                <div class="panel-body form-horizontal payment-form">
                    <?php
                    echo $this->Form->create('Absence');
                    echo $this->Form->hidden('id');
                    echo $this->Form->input('description', array(
                        'label' => 'Déscription du motif',
                        'class' => 'form-control'
                    ));

                    $sizes = array(
                        '' => 'Choisissez le motif de votre absence',
                        'Congés' => 'Congés',
                        'Formations' => 'Formations',
                        'Congrès' => 'Congrès',
                        'Réunions' => 'Réunions',
                        'Journée administrative' => 'Journée administrative',
                        'Maladie' => 'Maladie',
                        'Délai de route (déplacements inter-régionaux)' => 'Délai de route (déplacements inter-régionaux)',
                        'Autre' => 'Autre (avec possibilité de préciser la nature de l\'absence)'
                    );

                    echo $this->Form->input('titre', array(
                        'type' => 'select',
                        'options' => $sizes,
                        'label' => 'Motif Absence',
                        'class' => 'form-control',
                        'id' => 'motif-select'
                    ));

                    echo '<div id="autre-motif-wrapper" style="display:none;">';
                    echo $this->Form->input('autre_titre', array(
                        'label' => 'Précisez le motif',
                        'class' => 'form-control'
                    ));
                    echo '</div>';

                    ?>
                    <div class="col-md-12 col-xs-12" style="margin-bottom: 15px;">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" id="checkbox-part-jour"
                                    <?php echo (!empty($this->request->data['Absence']['part_jour'])) ? 'checked' : ''; ?>>
                                Une partie de la journée
                            </label>
                        </div>
                    </div>
                    <div class="col-md-6 col-xs-6" style="padding-left: 0px;">
                        <?php
                        echo $this->Form->input('date_debut', ['autocomplete' => 'off', 'type' => 'text', "required" => "required", 'class' => 'form-control', 'id' => 'datepicker', 'label' => "Date d'arrêt de travail"]);
                        ?>
                    </div>
                    <div class="col-md-6 col-xs-6 " style="padding: 0px;">
                        <?php
                        echo $this->Form->input('date_fin', [
                            'type' => 'text',
                            'class' => 'form-control',
                            'id' => 'datepicker1',
                            'label' => 'Date de reprise de travail',
                            'autocomplete' => 'off',
                            'div' => ['class' => 'div-date-fin']
                        ]);
                        ?>
                        <div class="form-group part_jour_group">
                            <label for="part_jour">Une partie de la journée</label>
                            <select name="data[Absence][part_jour]" id="part_jour" class="form-control select_part">
                                <option value="">Sélectionnez</option>
                                <option value="1/4" <?php echo (isset($this->request->data['Absence']['part_jour']) && $this->request->data['Absence']['part_jour'] == '1/4') ? 'selected' : ''; ?>>1/4</option>
                                <option value="1/2" <?php echo (isset($this->request->data['Absence']['part_jour']) && $this->request->data['Absence']['part_jour'] == '1/2') ? 'selected' : ''; ?>>1/2</option>
                                <option value="3/4" <?php echo (isset($this->request->data['Absence']['part_jour']) && $this->request->data['Absence']['part_jour'] == '3/4') ? 'selected' : ''; ?>>3/4</option>
                                <option value="1" <?php echo (isset($this->request->data['Absence']['part_jour']) && $this->request->data['Absence']['part_jour'] == '1') ? 'selected' : ''; ?>>4/4</option>
                            </select>
                        </div>

                    </div>
                    <?php echo $this->Form->end(array('label' => "J'envoie ma demande à mon responsable directe", 'class' => 'btn btn-primary btn-large', 'div' => array('class' => 'well text-center col-md-12'))); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var today = new Date();
        var minDate;
        

        // Last day of current month
        var lastDayOfMonth = new Date(
            today.getFullYear(),
            today.getMonth() + 1,
            0
        );

        // Get existing values from PHP
        var existingDateDebut = "<?php echo isset($this->request->data['Absence']['date_debut']) ? $this->request->data['Absence']['date_debut'] : ''; ?>";
        var existingDateFin = "<?php echo isset($this->request->data['Absence']['date_fin']) ? $this->request->data['Absence']['date_fin'] : ''; ?>";
        var existingPartJour = "<?php echo isset($this->request->data['Absence']['part_jour']) ? $this->request->data['Absence']['part_jour'] : ''; ?>";
        var existingTitre = "<?php echo isset($this->request->data['Absence']['titre']) ? $this->request->data['Absence']['titre'] : ''; ?>";

        // Set default dates
        var defaultDateDebut = existingDateDebut ? existingDateDebut : today;
        var defaultDateFin = existingDateFin ? existingDateFin : today;

        <?php if (AuthComponent::user('role') == 'Admin') { ?>
            minDate = null; // no limit for admin
        <?php } else { ?>
            minDate = new Date(today.getTime() - 24 * 60 * 60 * 1000); // yesterday
        <?php } ?>

        // Initialize date_debut (Date d'arrêt de travail)
        var dateDebutPicker = flatpickr("#datepicker", {
            locale: "fr",
            dateFormat: "Y-m-d",
            defaultDate: defaultDateDebut,
            minDate: minDate, // -1 day
            maxDate: lastDayOfMonth,
            onChange: function(selectedDates, dateStr, instance) {
                if (selectedDates.length > 0) {
                    // Get the selected date
                    var selectedDate = selectedDates[0];

                    // Calculate next day (selected date + 1 day)
                    var nextDay = new Date(selectedDate);
                    nextDay.setDate(nextDay.getDate() + 1);

                    // Update date_fin minimum date to be at least one day after date_debut
                    dateFinPicker.set('minDate', nextDay);

                    // Only set date_fin if checkbox is not checked
                    const checkbox = document.getElementById('checkbox-part-jour');
                    if (!checkbox.checked) {
                        // Check if current date_fin is less than the new minimum
                        var currentDateFin = dateFinPicker.selectedDates[0];
                        if (currentDateFin && currentDateFin <= selectedDate) {
                            // If date_fin is now invalid, set it to the next day
                            dateFinPicker.setDate(nextDay);
                        }
                    }
                }
            }
        });

        // Calculate minimum date for date_fin based on existing date_debut
        var minDateForDateFin = today;
        if (existingDateDebut) {
            var debutDate = new Date(existingDateDebut);
            var nextDay = new Date(debutDate);
            nextDay.setDate(nextDay.getDate() + 1);
            minDateForDateFin = nextDay;
        }

        // Initialize date_fin (Date de reprise de travail)
        var dateFinPicker = flatpickr("#datepicker1", {
            locale: "fr",
            dateFormat: "Y-m-d",
            defaultDate: defaultDateFin,
            minDate: minDateForDateFin, // Set minimum based on date_debut
            maxDate: lastDayOfMonth,
            onOpen: function(selectedDates, dateStr, instance) {
                // Re-check minimum date when opening the picker
                var dateDebut = dateDebutPicker.selectedDates[0];
                if (dateDebut) {
                    var nextDay = new Date(dateDebut);
                    nextDay.setDate(nextDay.getDate() + 1);
                    instance.set('minDate', nextDay);
                }
            }
        });

        // Handle "Autre" motif - show/hide on load
        const select = document.getElementById('motif-select');
        const otherWrapper = document.getElementById('autre-motif-wrapper');

        if (select && otherWrapper) {
            // Check on page load
            if (existingTitre === 'Autre') {
                otherWrapper.style.display = 'block';
            }

            select.addEventListener('change', function() {
                if (select.value === 'Autre') {
                    otherWrapper.style.display = 'block';
                } else {
                    otherWrapper.style.display = 'none';
                }
            });
        }

        // Handle "Une partie de la journée" checkbox
        const checkbox = document.getElementById('checkbox-part-jour');
        const divDateFin = document.querySelector('.div-date-fin');
        const partJourGroup = document.querySelector('.part_jour_group');
        const partJourSelect = document.getElementById('part_jour');

        if (checkbox && divDateFin && partJourGroup && partJourSelect) {
            // Initialize display on page load based on existing data
            if (existingPartJour) {
                divDateFin.style.display = 'none';
                partJourGroup.style.display = 'block';
            } else {
                divDateFin.style.display = 'block';
                partJourGroup.style.display = 'none';
            }

            checkbox.addEventListener('change', function() {
                if (checkbox.checked) {
                    // Hide date_fin and show part_jour selector
                    divDateFin.style.display = 'none';
                    partJourGroup.style.display = 'block';

                    // Clear date_fin value
                    dateFinPicker.clear();

                } else {
                    // Show date_fin and hide part_jour selector
                    divDateFin.style.display = 'block';
                    partJourGroup.style.display = 'none';

                    // Clear part_jour select value
                    partJourSelect.value = '';

                    // Reset date_fin to next day after date_debut
                    var dateDebut = dateDebutPicker.selectedDates[0];
                    if (dateDebut) {
                        var nextDay = new Date(dateDebut);
                        nextDay.setDate(nextDay.getDate() + 1);
                        dateFinPicker.setDate(nextDay);
                    } else {
                        dateFinPicker.setDate(today);
                    }
                }
            });
        }
    });
</script>