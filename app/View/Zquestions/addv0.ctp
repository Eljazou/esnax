<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plan d’actions 2024</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://demo.adminkit.io/css/light.css" rel="stylesheet">


    <style>
        .form-label {
            font-size: 16px;
        }

        .radio-buttons-container {
            display: flex;
            align-items: center;
            gap: 24px;
            flex-wrap: wrap;
        }

        .radio-button {
            display: inline-block;
            position: relative;
            cursor: pointer;
        }

        .radio-button__input {
            position: absolute;
            opacity: 0;
            width: 0;
            height: 0;
        }

        .radio-button__label {
            display: inline-block;
            padding-left: 30px;
            margin-bottom: 10px;
            position: relative;
            font-size: 16px;
            color: #393939;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.23, 1, 0.320, 1);
        }

        .radio-button__custom {
            position: absolute;
            top: 50%;
            left: 0;
            transform: translateY(-50%);
            width: 20px;
            height: 20px;
            border-radius: 50%;
            border: 2px solid #555;
            transition: all 0.3s cubic-bezier(0.23, 1, 0.320, 1);
        }

        .radio-button__input:checked+.radio-button__label .radio-button__custom {
            transform: translateY(-50%) scale(0.9);
            border: 5px solid #4c8bf5;
            color: #4c8bf5;
        }

        .radio-button__input:checked+.radio-button__label {
            color: #4c8bf5;
        }

        .radio-button__label:hover .radio-button__custom {
            transform: translateY(-50%) scale(1.2);
            border-color: #4c8bf5;
            box-shadow: 0 0 10px #4c8bf580;
        }

        .br-p20 {
            border-top: 1px solid #dcdcdc;
            padding-top: 20px;

        }

        .select {
            width: 100%;
        }

        .question-group {
            display: none;
        }

        .dots {
            display: flex;
            align-items: center;
            justify-content: center;
            column-gap: 7px;
        }

        .dot {
            width: 8px;
            height: 8px;
            background-color: #b2b2b2;
            border-radius: 20px;
        }

        .dot.active {
            transition: 0.5s;
            width: 28px;
            background: #3b7ddd;
        }

        .invalid {
            border: 1px solid red;
            background-color: #ffe6e6;
        }
    </style>
</head>

<body>
    <div class="container mt-5 pb-5">

        <div class="card">
            <div class="card-header text-center">
                <div class="dots">
                </div>
            </div>
            <div class="card-body">
                <?php echo $this->Form->create('Zquestion', ['class' => 'needs-validation row g-3']); ?>

                <!-- Nom Field -->
                <div class="col-md-12 br-p20 question-group etap0">
                    <?php echo $this->Form->input('nom', [
                        "label" => "Nom et prénom",
                        "class" => "form-control",
                        "placeholder" => "Entrez votre Nom prénom",
                        "required" => "required"
                    ]); ?>
                </div>

                <!-- Question 1 -->
                <?php $i = $radio = 0;
                $e = 0;
                foreach ($json as $titre => $allquestions): ?>

                    <?php
                    $countallqsts =  count($allquestions);
                    foreach ($allquestions as $soustitre => $questions):
                        $e++;
                    ?>
                        <div class=" question-group etap<?php echo $e ?>">
                            <!-- <h1><?php echo $titre . " - " . str_replace("_", " ", $soustitre); ?></h1> -->
                            <h1><?php echo "Chapitre " . $e . "/<span class='totaletaps'></span>"; ?></h1>
                            <?php foreach ($questions["questions"] as $question):
                                $i++;
                                echo $this->Form->hidden("$i.titre", ["value" => $titre]);
                                echo $this->Form->hidden("$i.soustitre", ["value" => $soustitre]);
                                echo $this->Form->hidden("$i.question", ["value" => $question["question"]]);
								$type="";
								if(isset($question["type"]))
									$type="multi";
                                echo $this->Form->hidden("$i.type", ["value" => $type]);
								
								if($type!="") {?>
									<div class="col-md-12 br-p20">
										<label for="qs1" class="form-label"><?php echo $question["question"]; ?></label>
										<div class="checkbox-buttons-container">
											<?php foreach ($question["options"] as $k => $v): $radio++; ?>
												<div class="checkbox-button">
													<input name="data[Zquestion][<?php echo $i ?>][repense][]" id="<?php echo $radio ?>" class="checkbox-button__input" type="checkbox" value="<?php echo $v ?>">
													<label for="<?php echo $radio ?>" class="checkbox-button__label">
														<span class="checkbox-button__custom"></span><?php echo $v ?>
													</label>
												</div>
											<?php endforeach; ?>
										</div>
									</div>
                                <?php }
								else if (count($question["options"]) > 4) { ?>
                                    <div class="col-md-12 br-p20">
                                        <div class="radio-buttons-container">
                                            <?php $options = array();
                                            foreach ($question["options"] as $k => $v)
                                                $options[$v] = $v;
                                            echo $this->Form->input("$i.repense", array(
                                                'type' => 'select',
                                                'options' => $options,
                                                'empty' => 'Sélectionnez une option',
                                                'label' => $question["question"],
                                                'class' => "form-control",
                                                "required" => "required"
                                            ));
                                            ?>

                                        </div>
                                    </div>
                                <?php } else { ?>
                                    <div class="col-md-12 br-p20">
                                        <label for="qs1" class="form-label"><?php echo $question["question"]; ?></label>
                                        <div class="radio-buttons-container">
                                            <?php foreach ($question["options"] as $k => $v): $radio++; ?>
                                                <div class="radio-button">
                                                    <input required="required" name="data[Zquestion][<?php echo $i ?>][repense]" id="<?php echo $radio ?>" class="radio-button__input" type="radio" value="<?php echo $v ?>">
                                                    <label for="<?php echo $radio ?>" class="radio-button__label">
                                                        <span class="radio-button__custom"></span><?php echo $v ?>
                                                    </label>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>

                            <?php }
                            endforeach; ?>
                        </div>
                    <?php endforeach; ?>
                <?php endforeach; ?>


                <!-- Submit Button -->
                <div class="col-md-12">
                    <div class="d-flex justify-content-between mt-4 gap-3">
                        <button type="button" id="prevBtn" class="col btn btn-secondary " style="display: none;">Précédent</button>
                        <button type="button" id="nextBtn" class="col btn btn-primary">Démarrer</button>
                    </div>

                </div>

                <?php echo $this->Form->end(); ?>
            </div>
        </div>


    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>


    <script>
        $(document).ready(function() {
            let currentGroupIndex = 0;
            $(".question-group").eq(currentGroupIndex).show();
            const totalGroups = $(".question-group").length;
            $(".totaletaps").text(totalGroups - 1);

            for (let i = 0; i < totalGroups; i++) {
                $('.dots').append("<div class='dot'></div>");

            }
            $(".dot").eq(currentGroupIndex).addClass('active');
            $("#ZquestionAddForm").on("submit", function(event) {
                if (currentGroupIndex !== totalGroups - 1) {
                    event.preventDefault(); // Prevent submission
                }
            });




            $("#nextBtn").click(function() {
                // Validate inputs in the current group
                const currentGroup = $(".question-group").eq(currentGroupIndex);

                const invalidInputs = currentGroup.find("[required]").filter(function() {
                    if (this.type === "radio") {
                        // For radio buttons, check if at least one is checked in the group
                        return currentGroup.find(`input[name="${this.name}"]:checked`).length === 0;
                    }
                    if (this.tagName === "SELECT") {
                        // For select elements, check if the value is empty
                        return !this.value.trim();
                    }
                    return !this.value.trim(); // For other input types
                });

                if (invalidInputs.length > 0) {
                    alert("Veuillez remplir tous les champs obligatoires."); // Notify the user

                    invalidInputs.each(function() {
                        if (this.type === "radio") {
                            currentGroup
                                .find(`input[name="${this.name}"]`)
                                .closest(".radio-buttons-container")
                                .addClass("invalid");
                        } else if (this.tagName === "SELECT") {
                            $(this).addClass("invalid"); // Highlight invalid select
                        } else {
                            $(this).addClass("invalid"); // Highlight other invalid inputs
                        }
                    });

                    invalidInputs.first().focus(); // Focus on the first invalid input
                    return; // Prevent navigation to the next group
                } else {
                    // Remove invalid highlights if all are valid
                    currentGroup.find(".invalid").removeClass("invalid");
                }

                if (currentGroupIndex < totalGroups - 1) {
                    $(".question-group").eq(currentGroupIndex).hide();
                    $(".dot").eq(currentGroupIndex).removeClass("active");
                    currentGroupIndex++;
                    $(".question-group").eq(currentGroupIndex).show();
                    $(".dot").eq(currentGroupIndex).addClass("active");
                    updateButtons();
                } else {
                    $("form").submit();
                }
            });



            $("#prevBtn").click(function() {
                if (currentGroupIndex > 0) {
                    $(".question-group").eq(currentGroupIndex).hide();
                    $(".dot").eq(currentGroupIndex).removeClass('active');
                    currentGroupIndex--;
                    $(".question-group").eq(currentGroupIndex).show();
                    $(".dot").eq(currentGroupIndex).addClass('active');
                }
                updateButtons();
            });

            function updateButtons() {
                $("#prevBtn").toggle(currentGroupIndex > 0);
                $("#nextBtn").text(currentGroupIndex === totalGroups - 1 ? "Soumettre" : "Suivant");
            }



        });
    </script>
</body>

</html>