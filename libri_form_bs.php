<div class="input-group">
<div  class="input-group-prepend">
			<span class="input-group-text" id="basic-addon1">Titolo ISBDM:*</span>
		</div>
  <textarea class="form-control" name="titolo_isbdm"   rows="3" id="titolo_isbdm"title="descrizione completa ISBD(M)"><?php echo $titolo_isbdm;?></textarea>
</div> 
<div class="input-group">
<div  class="input-group-prepend">
			<span class="input-group-text" id="basic-addon1">Copertine</span>
		</div>
  <textarea class="form-control" name="testi_copertine"   rows="3" id="testi_copertine"title="testi delle copertine e dei risvolti"><?php echo $testi_copertine;?></textarea>
</div>

<div Class="input-group">
		<div  class="input-group-prepend">
			<span class="input-group-text" id="basic-addon1">Recensione:</span>
		</div>
		<input type="text" class="form-control" name="recensione_url"  placeholder="url risorsa elettronica" value= "<?php echo htmlentities($recensione_url, ENT_COMPAT, 'utf-8');?>" id="recensione_url" >
    </div>

<div Class="input-group">
		<div  class="input-group-prepend">
			<span class="input-group-text" id="basic-addon1">Titolo uniforme:</span>
		</div>
		<input type="text" class="form-control" name="titolo_uniforme"  placeholder="titolo uniforme" value="<?php echo htmlentities($titolo_uniforme, ENT_COMPAT, 'utf-8');?>" id="titolo_uniforme" >
	</div>
<div Class="input-group">
		<div  class="input-group-prepend">
			<span class="input-group-text" id="basic-addon1">Titolo originale:</span>
		</div>
		<input type="text" class="form-control" name="titolo_originale"  placeholder="titolo originale" value="<?php echo htmlentities($titolo_originale, ENT_COMPAT, 'utf-8');?>" id="titolo_originale" >
        <span class="error"> <?php echo $titolo_originaleErr;?></span>
    </div>
    <div Class="input-group">
		<div  class="input-group-prepend">
			<span class="input-group-text" id="basic-addon1">Editore:*</span>
		</div>
		<input type="text" class="form-control" name="editore"  placeholder="editore" value="<?php echo htmlentities($editore, ENT_COMPAT, 'utf-8');?>" id="editore" >
    </div>
    <div Class="input-group">
		<div  class="input-group-prepend">
			<span class="input-group-text" id="basic-addon1">Anno:*</span>
		</div>
		<input type="text" class="form-control" name="anno"  placeholder="anno" value="<?php echo htmlentities($anno, ENT_COMPAT, 'utf-8');?>" id="anno" >
    </div>
    <div Class="input-group">
		<div  class="input-group-prepend">
			<span class="input-group-text" id="basic-addon1">Collezione:</span>
		</div>
		<input type="text" class="form-control" name="collezione"  placeholder="collezione" value="<?php echo htmlentities($collezione, ENT_COMPAT, 'utf-8');?>" id="collezione" >
    </div>
    <div Class="input-group">
		<div  class="input-group-prepend">
			<span class="input-group-text" id="basic-addon1"># Collezione:</span>
		</div>
		<input type="text" class="form-control" name="collezione_nr"  placeholder="# collezione numero" value="<?php echo htmlentities($collezione_nr, ENT_COMPAT, 'utf-8');?>" id="collezione_nr" >
    </div>
    <div Class="input-group">
		<div  class="input-group-prepend">
			<span class="input-group-text" id="basic-addon1">sezione:</span>
		</div>
		<input type="text" class="form-control" name="sezione"  placeholder="sezione della collezione dei libri" value="<?php echo htmlentities($sezione, ENT_COMPAT, 'utf-8');?>" id="sezione" >
    </div>    
    <div Class="input-group">
		<div  class="input-group-prepend">
			<span class="input-group-text" id="basic-addon1">Gruppo:</span>
		</div>
		<input type="text" class="form-control" name="gruppo"  placeholder="gruppo" value="<?php echo htmlentities($gruppo, ENT_COMPAT, 'utf-8');?>" id="gruppo" >
    </div>
    <div Class="input-group">
		<div  class="input-group-prepend">
			<span class="input-group-text" id="basic-addon1">Pagine:</span>
		</div>
		<input type="text" class="form-control" name="pagine"  placeholder="pagine" value="<?php echo htmlentities($pagine, ENT_COMPAT, 'utf-8');?>" id="pagine" >
    </div>
    <div Class="input-group">
		<div  class="input-group-prepend">
			<span class="input-group-text" id="basic-addon1">Altezza:</span>
		</div>
		<input type="text" class="form-control" name="altezza"  placeholder="altezza" value="<?php echo htmlentities($altezza, ENT_COMPAT, 'utf-8');?>" id="altezza" >
    </div>
    <div Class="input-group">
		<div  class="input-group-prepend">
			<span class="input-group-text" id="basic-addon1">ISBN:</span>
		</div>
		<input type="text" class="form-control" name="isbn"  placeholder="ISBN #" value="<?php echo htmlentities($isbn, ENT_COMPAT, 'utf-8');?>" id="isbn" >
    </div>
    <div Class="input-group">
		<div  class="input-group-prepend">
			<span class="input-group-text" id="basic-addon1">ISBD(M) URL:</span>
		</div>
		<input type="text" class="form-control" name="url"  placeholder="url isbd(m)" value="<?php echo htmlentities($url, ENT_COMPAT, 'utf-8');?>" id="url" >
    </div>
    <div Class="input-group">
	 <div  class="input-group-prepend">
			<span class="input-group-text" id="basic-addon1">Copertina:</span>
	 </div>
		<input type="text" class="form-control" name="copertina"  placeholder="copertine/" value="<?php echo htmlentities($copertina, ENT_COMPAT, 'utf-8');?>" id="copertina" >
    </div>
	 <div Class="input-group">
	 	<div  class="input-group-prepend">
			<span class="input-group-text" id="basic-addon1">Dorso:</span>
	 	</div>
		<input type="text" class="form-control" name="dorso"  placeholder="copertine/" value="<?php echo htmlentities($dorso, ENT_COMPAT, 'utf-8');?>" id="dorso" >
	 	</div>		
    <div Class="input-group">
		<div  class="input-group-prepend">
			<span class="input-group-text" id="basic-addon1">Posizione:</span>
		</div>
		<input type="text" class="form-control" name="posizione"  placeholder="posizione / collocazione" value="<?php echo htmlentities($posizione, ENT_COMPAT, 'utf-8');?>" id="posizione" >
    </div>
	<div Class="input-group">
		<div  class="input-group-prepend">
			<span class="input-group-text" id="basic-addon1">Pubblicazione:</span>
		</div>
		<input type="text" class="form-control" name="pubblicazione_tipo"  placeholder="Tipo di pubblicazione: pubblicazione a stampa, risorsa elettronica, ..." value="<?php echo htmlentities($pubblicazione_tipo, ENT_COMPAT, 'utf-8');?>" id="pubblicazione_tipo" >
    </div>
	<div Class="input-group">
		<div  class="input-group-prepend">
			<span class="input-group-text" id="basic-addon1">Risorsa:</span>
		</div>
		<input type="text" class="form-control" name="pubblicazione_url"  placeholder="url risorsa elettronica" value= "<?php echo htmlentities($pubblicazione_url, ENT_COMPAT, 'utf-8');?>" id="pubblicazione_url" >
    </div>
    <div Class="input-group">
		<div  class="input-group-prepend">
			<span class="input-group-text" id="basic-addon1">Libreria:</span>
		</div>
		<input type="text" class="form-control" name="libreria"  placeholder="libreria / negozio" value="<?php echo htmlentities($libreria, ENT_COMPAT, 'utf-8');?>" id="libreria" >
    </div>
    <div Class="input-group">
		<div  class="input-group-prepend">
			<span class="input-group-text" id="basic-addon1">Data:</span>
		</div>
		<input type="text" class="form-control" name="data"  placeholder="data di acquisto" value="<?php echo htmlentities($data, ENT_COMPAT, 'utf-8');?>" id="data" >
    </div>
    <div Class="input-group">
		<div  class="input-group-prepend">
			<span class="input-group-text" id="basic-addon1">Annotazioni:</span>
		</div>
		<input type="text" class="form-control" name="note"  placeholder="annotazioni" value="<?php echo htmlentities($note, ENT_COMPAT, 'utf-8');?>" id="note" >
    </div>

