<div id="myFiltersCard" class="col-md-3 pt-3 d-none d-md-block myFiltersCard">
    <div class="row d-md-none sticky-top bg-white">
        <div class="col-12">
            <div class="row">
                <h4 class="col-6 py-3 myFont-size-18 font-weight-bold"><?php echo count(findBy('products', ['subcategory' => $subcatId])) ?>
                    produse</h4>

                <div class="col-2 py-2"></div>

                <div class="col-4 py-2 clearfix">
                    <button id="myFiltersCard-displayBtn" class="btn btn-primary float-right">Afiseaza</button>
                </div>
            </div>
        </div>

        <div class="col-12 py-2 border-top border-secondary shadow p-3 mb-5 bg-white rounded grey-text myMb-0-fix">
            <p>Nu au fost aplicate filtre</p>
        </div>
    </div>

    <!-- Disponibilitate -->
    <div class="col-12 px-0 mb-3 border-bottom border-secondary">
        <p>
            <button class="btn btn-light w-100 text-left" type="button" data-toggle="collapse"
                    data-target="#dispCollapse"
                    aria-expanded="false" aria-controls="collapseExample">
                Disponibilitate
            </button>
        </p>

        <div class="collapse" id="dispCollapse">
            <div class="row">
                <div class="col-12 input-group">
                    <a class="input-group-prepend w-100 cursor-pointer myFilter-link">
                        <div class="input-group-text border-0 w-100">
                            <input class="cursor-pointer" type="checkbox" name="dispInStoc" id="dispInStoc"
                                   aria-label="Checkbox for following text input">
                            <label class="mt-1 cursor-pointer" for="dispInStoc">&nbsp; In stoc</label>
                        </div>
                    </a>
                </div>
            </div>

            <div class="row">
                <div class="col-12 input-group">
                    <a class="input-group-prepend w-100 cursor-pointer myFilter-link">
                        <div class="input-group-text border-0 w-100">
                            <input class="cursor-pointer" type="checkbox" name="dispPromotii" id="dispPromotii"
                                   aria-label="Checkbox for following text input">
                            <label class="mt-1 cursor-pointer" for="dispPromotii">&nbsp; Promotii</label>
                        </div>
                    </a>
                </div>
            </div>

            <div class="row">
                <div class="col-12 input-group">
                    <a class="input-group-prepend w-100 cursor-pointer myFilter-link">
                        <div class="input-group-text border-0 w-100">
                            <input class="cursor-pointer" type="checkbox" name="dispNoutati" id="dispNoutati"
                                   aria-label="Checkbox for following text input">
                            <label class="mt-1 cursor-pointer" for="dispNoutati">&nbsp; Noutati</label>
                        </div>
                    </a>
                </div>
            </div>

            <div class="row">
                <div class="col-12 input-group">
                    <a class="input-group-prepend w-100 cursor-pointer myFilter-link">
                        <div class="input-group-text border-0 w-100">
                            <input class="cursor-pointer" type="checkbox" name="dispResigilate" id="dispResigilate"
                                   aria-label="Checkbox for following text input">
                            <label class="mt-1 cursor-pointer" for="dispResigilate">&nbsp; Resigilate</label>
                        </div>
                    </a>
                </div>
            </div>

            <div class="row">
                <div class="col-12 input-group">
                    <a class="input-group-prepend w-100 cursor-pointer myFilter-link">
                        <div class="input-group-text border-0 w-100">
                            <input class="cursor-pointer" type="checkbox" name="dispLichidariStoc" id="dispLichidariStoc"
                                   aria-label="Checkbox for following text input">
                            <label class="mt-1 cursor-pointer" for="dispLichidariStoc">&nbsp; Lichidari de stoc</label>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Preturi -->
    <div class="col-12 px-0 border-bottom border-secondary">
        <p>
            <button class="btn btn-light w-100 text-left" type="button" data-toggle="collapse"
                    data-target="#pretCollapse"
                    aria-expanded="false" aria-controls="collapseExample">
                Pret
            </button>
        </p>

        <div class="collapse" id="pretCollapse">
            <div class="row">
                <div class="col-12 input-group">
                    <a class="input-group-prepend w-100 cursor-pointer myFilter-link">
                        <div class="input-group-text border-0 w-100">
                            <input class="cursor-pointer" type="checkbox" name="priceInt1" id="priceInt1"
                                   aria-label="Checkbox for following text input">
                            <label class="mt-1 cursor-pointer" for="priceInt1">&nbsp; 500 - 1000</label>
                        </div>
                    </a>
                </div>
            </div>

            <div class="row">
                <div class="col-12 input-group">
                    <a class="input-group-prepend w-100 cursor-pointer myFilter-link">
                        <div class="input-group-text border-0 w-100">
                            <input class="cursor-pointer" type="checkbox" name="priceInt2" id="priceInt2"
                                   aria-label="Checkbox for following text input">
                            <label class="mt-1 cursor-pointer" for="priceInt2">&nbsp; 1000 - 1500</label>
                        </div>
                    </a>
                </div>
            </div>

            <div class="row">
                <div class="col-12 input-group">
                    <a class="input-group-prepend w-100 cursor-pointer myFilter-link">
                        <div class="input-group-text border-0 w-100">
                            <input class="cursor-pointer" type="checkbox" name="priceInt3" id="priceInt3"
                                   aria-label="Checkbox for following text input">
                            <label class="mt-1 cursor-pointer" for="priceInt3">&nbsp; 1500 - 2000</label>
                        </div>
                    </a>
                </div>
            </div>

            <div class="row">
                <div class="col-12 input-group">
                    <a class="input-group-prepend w-100 cursor-pointer myFilter-link">
                        <div class="input-group-text border-0 w-100">
                            <input class="cursor-pointer" type="checkbox" name="priceInt4" id="priceInt4"
                                   aria-label="Checkbox for following text input">
                            <label class="mt-1 cursor-pointer" for="priceInt4">&nbsp; 2000 - 3000</label>
                        </div>
                    </a>
                </div>
            </div>

            <div class="row">
                <div class="col-12 input-group">
                    <a class="input-group-prepend w-100 cursor-pointer myFilter-link">
                        <div class="input-group-text border-0 w-100">
                            <input class="cursor-pointer" type="checkbox" name="priceInt5" id="priceInt5"
                                   aria-label="Checkbox for following text input">
                            <label class="mt-1 cursor-pointer" for="priceInt5">&nbsp; 3000 - 4000</label>
                        </div>
                    </a>
                </div>
            </div>

            <div class="row">
                <div class="col-12 input-group">
                    <a class="input-group-prepend w-100 cursor-pointer myFilter-link">
                        <div class="input-group-text border-0 w-100">
                            <input class="cursor-pointer" type="checkbox" name="priceInt6" id="priceInt6"
                                   aria-label="Checkbox for following text input">
                            <label class="mt-1 cursor-pointer" for="priceInt6">&nbsp; 4000 - 5000</label>
                        </div>
                    </a>
                </div>
            </div>

            <div class="row">
                <div class="col-12 input-group">
                    <a class="input-group-prepend w-100 cursor-pointer myFilter-link">
                        <div class="input-group-text border-0 w-100">
                            <input class="cursor-pointer" type="checkbox" name="priceInt7" id="priceInt7"
                                   aria-label="Checkbox for following text input">
                            <label class="mt-1 cursor-pointer" for="priceInt7">&nbsp; Peste 5000</label>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Brand -->
    <div class="col-12 px-0 mb-3 border-bottom border-secondary">
        <p>
            <button class="btn btn-light w-100 text-left" type="button" data-toggle="collapse"
                    data-target="#brandCollapse"
                    aria-expanded="false" aria-controls="collapseExample">
                Brand
            </button>
        </p>

        <div class="collapse" id="brandCollapse">
            <?php foreach (ProductBrand::findByLike(['id' => '%%']) as $brand): ?>
            <div class="row">
                <div class="col-12 input-group">
                    <a class="input-group-prepend w-100 cursor-pointer myFilter-link">
                        <div class="input-group-text border-0 w-100">
                            <input class="cursor-pointer" type="checkbox" name="<?php echo $brand->brand_name ?>" id="<?php echo $brand->brand_name ?>"
                                   aria-label="Checkbox for following text input">
                            <label class="mt-1 cursor-pointer" for="<?php echo $brand->brand_name ?>">&nbsp; <?php echo $brand->brand_name ?></label>
                        </div>
                    </a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>