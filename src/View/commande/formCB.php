<style>@import url(https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/5.3.45/css/materialdesignicons.min.css);</style>
<style>
    .form-radio {
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        -webkit-print-color-adjust: exact;
        color-adjust: exact;
        display: inline-block;
        vertical-align: middle;
        background-origin: border-box;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        flex-shrink: 0;
        border-radius: 100%;
        border-width: 2px;
    }

    .form-radio:checked {
        background-image: url("data:image/svg+xml,%3csvg viewBox='0 0 16 16' fill='white' xmlns='http://www.w3.org/2000/svg'%3e%3ccircle cx='8' cy='8' r='3'/%3e%3c/svg%3e");
        border-color: transparent;
        background-color: currentColor;
        background-size: 100% 100%;
        background-position: center;
        background-repeat: no-repeat;
    }

    @media not print {
        .form-radio::-ms-check {
            border-width: 1px;
            color: transparent;
            background: inherit;
            border-color: inherit;
            border-radius: inherit;
        }
    }

    .form-radio:focus {
        outline: none;
    }

    .form-select {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='%23a0aec0'%3e%3cpath d='M15.3 9.3a1 1 0 0 1 1.4 1.4l-4 4a1 1 0 0 1-1.4 0l-4-4a1 1 0 0 1 1.4-1.4l3.3 3.29 3.3-3.3z'/%3e%3c/svg%3e");
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        -webkit-print-color-adjust: exact;
        color-adjust: exact;
        background-repeat: no-repeat;
        padding-top: 0.5rem;
        padding-right: 2.5rem;
        padding-bottom: 0.5rem;
        padding-left: 0.75rem;
        font-size: 1rem;
        line-height: 1.5;
        background-position: right 0.5rem center;
        background-size: 1.5em 1.5em;
    }

    .form-select::-ms-expand {
        color: #a0aec0;
        border: none;
    }

    @media not print {
        .form-select::-ms-expand {
            display: none;
        }
    }

    @media print and (-ms-high-contrast: active), print and (-ms-high-contrast: none) {
        .form-select {
            padding-right: 0.75rem;
        }
    }
</style>


<form method="<?php echo $debug ? "get" : "post" ?>" action="frontController.php">
    <div class="min-w-screen min-h-screen bg-gray-200 flex items-center justify-center px-5 pb-10 pt-16">
        <div class="w-full mx-auto rounded-lg bg-white shadow-lg p-5 text-gray-700" style="max-width: 600px">
            <div class="w-full pt-1 pb-5">
                <div class="bg-indigo-500 text-white overflow-hidden rounded-full w-20 h-20 -mt-16 mx-auto shadow-lg flex justify-center items-center">
                    <i class="mdi mdi-credit-card-outline text-3xl"></i>
                </div>
            </div>
            <div class="mb-10">
                <h1 class="text-center font-bold text-xl uppercase">Secure payment info</h1>
            </div>
            <div class="mb-3 flex -mx-2">
                <div class="px-2">
                    <label for="type1" class="flex items-center cursor-pointer">
                        <input checked id="type1" name="type" type="radio" class="form-radio h-5 w-5 text-indigo-500">
                        <img src="https://leadershipmemphis.org/wp-content/uploads/2020/08/780370.png"
                             class="h-8 ml-3" alt="...">
                    </label>
                </div>
                <div class="px-2">
                    <label for="type2" class="flex items-center cursor-pointer">
                        <input type="radio" class="form-radio h-5 w-5 text-indigo-500" name="type" id="type2"
                        >
                        <img src="https://www.sketchappsources.com/resources/source-image/PayPalCard.png"
                             class="h-8 ml-3" alt="...">
                    </label>
                </div>
            </div>
            <div class="mb-3">
                <label for="nom_id" class="font-bold text-sm mb-2 ml-1">Nom du titulaire</label>
                <div>
                    <input id="nom_id"
                           class="w-full px-3 py-2 mb-1 border-2 border-gray-200 rounded-md focus:outline-none focus:border-indigo-500 transition-colors"
                           placeholder="John Smith" type="text" name="nom"
                           value="<?= htmlspecialchars($val['nom']) ?>" required/>
                </div>
            </div>
            <div class="mb-3">
                <label for="num_id" class="font-bold text-sm mb-2 ml-1">Numéro de la carte</label>
                <div>
                    <input id="num_id"
                           class="w-full px-3 py-2 mb-1 border-2 border-gray-200 rounded-md focus:outline-none focus:border-indigo-500 transition-colors"
                           placeholder="0000 0000 0000 0000" type="number" name="num"
                           value="<?= htmlspecialchars($val['num']) ?>" required/>
                </div>
            </div>
            <div class="mb-3 -mx-2 flex items-end">
                <div class="px-2 w-1/2">
                    <label for="mois_id" class="font-bold text-sm mb-2 ml-1">Date d'expiration</label>
                    <div>
                        <select id="mois_id" name="mois"
                                class="form-select w-full px-3 py-2 mb-1 border-2 border-gray-200 rounded-md focus:outline-none focus:border-indigo-500 transition-colors cursor-pointer">
                            <option value="01" <?= $val['mois'] == "1" ? "selected" : "" ?> >01 - Janvier</option>
                            <option value="02" <?= $val['mois'] == "2" ? "selected" : "" ?> >02 - Fevrier</option>
                            <option value="03" <?= $val['mois'] == "3" ? "selected" : "" ?> >03 - Mars</option>
                            <option value="04" <?= $val['mois'] == "4" ? "selected" : "" ?> >04 - Avril</option>
                            <option value="05" <?= $val['mois'] == "5" ? "selected" : "" ?> >05 - Mai</option>
                            <option value="06" <?= $val['mois'] == "6" ? "selected" : "" ?> >06 - Juin</option>
                            <option value="07" <?= $val['mois'] == "7" ? "selected" : "" ?> >07 - Juillet</option>
                            <option value="08" <?= $val['mois'] == "8" ? "selected" : "" ?> >08 - Aout</option>
                            <option value="09" <?= $val['mois'] == "9" ? "selected" : "" ?> >09 - Septembre</option>
                            <option value="10" <?= $val['mois'] == "10" ? "selected" : "" ?> >10 - Octobre</option>
                            <option value="11" <?= $val['mois'] == "11" ? "selected" : "" ?> >11 - Novembre</option>
                            <option value="12" <?= $val['mois'] == "12" ? "selected" : "" ?> >12 - Decembre</option>
                        </select>
                    </div>
                </div>
                <div class="px-2 w-1/2">
                    <select id="mois_id" name="an"
                            class="form-select w-full px-3 py-2 mb-1 border-2 border-gray-200 rounded-md focus:outline-none focus:border-indigo-500 transition-colors cursor-pointer">
                        <option value="2023" <?= $val['an'] == "2023" ? "selected" : "" ?> >2023</option>
                        <option value="2024" <?= $val['an'] == "2024" ? "selected" : "" ?> >2024</option>
                        <option value="2025" <?= $val['an'] == "2025" ? "selected" : "" ?> >2025</option>
                        <option value="2026" <?= $val['an'] == "2026" ? "selected" : "" ?> >2026</option>
                        <option value="2027" <?= $val['an'] == "2027" ? "selected" : "" ?> >2027</option>
                        <option value="2028" <?= $val['an'] == "2028" ? "selected" : "" ?> >2028</option>
                        <option value="2029" <?= $val['an'] == "2029" ? "selected" : "" ?> >2029</option>
                    </select>
                </div>
            </div>
            <div class="mb-10">
                <label for="crypto_id" class="font-bold text-sm mb-2 ml-1">Security code</label>
                <div>
                    <input id="crypto_id"
                           class="w-32 px-3 py-2 mb-1 border-2 border-gray-200 rounded-md focus:outline-none focus:border-indigo-500 transition-colors"
                           name="crypto" placeholder="000" type="text" required/>
                </div>
            </div>
            <div>
                <button type="submit"
                        class="block w-full max-w-xs mx-auto bg-indigo-500 hover:bg-indigo-700 focus:bg-indigo-700 text-white rounded-lg px-3 py-3 font-semibold">
                    <i class="mdi mdi-lock-outline mr-1"></i> PAYER <?= $total ?> €
                </button>
                <input type="hidden" name="action" value="validerCommande"/>
                <input type="hidden" name="controller" value="commande"/>
            </div>
        </div>
    </div>
</form>