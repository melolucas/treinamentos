<style>
    .btn-dark {
        background-color: #222222;
        border-color: #222222;
        color: white;
    }
</style>

<center>
    <div class="container" style="margin-top: 5%; margin-left: 14%">
        <form method="POST" action="<?php echo base_url('index.php/RelatoriosEad/regiaoum'); ?>">                
            <div class="container">
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <p class="" style="text-align: left;"><b>Escolha um curso:</b></p>
                            <select class="form-control" id="curso" name="curso" required>
                                <?php foreach ($cursos as $key) { ?>
                                    <option value="<?= $key->id; ?>"><?= $key->nome; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div> 
                    <div class="col-md-3"></div>           
                </div>

                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <p class="" style="text-align: left;"><b>Escolha uma função:</b></p>
                            <select class="form-control" id="cargo" name="cargo" required>
                                <?php foreach ($cargos as $key) { ?>
                                    <option value="<?= $key->id; ?>"><?= $key->nome; ?></option>
                                <?php } ?>   
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3"></div>
                </div>

                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <p class="" style="text-align: left;"><b>Escolha uma região:</b></p>
                            <select class="form-control" id="regiao" name="regiao" required>                                
                                <option value="999">Sem região</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                            </select>
                        </div>
                        <button class="btn btn-dark" type="submit">Buscar</button>
                    </div>
                </div>
                <div class="col-md-3"></div>  
            </form>         
    </div>
</center>