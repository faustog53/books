
  <div class="input-group">
  Titolo: <textarea name="titolo_isbdm" rows="5" cols="60" title="descrizione completa ISBD(M)"><?php echo $titolo_isbdm;?></textarea>
  <span class="error">* <?php echo $titolo_isbdmErr;?></span>
  </div>
  <div class="input-group">
  Titolo originale: <input type="text" name="titolo_originale" value="<?php echo $titolo_originale;?>" size="60">
  <span class="error"> <?php echo $titolo_originaleErr;?></span>
  </div>
  <div class="input-group">
  Editore: <input type="text" name="editore" value="<?php echo $editore;?>" size="60">
  <span class="error">* <?php echo $editoreErr;?></span>
  </div>
  <div class="input-group">
  Anno: <input type="text" name="anno" value="<?php echo $anno;?>" size="4">
  <span class="error">* <?php echo $annoErr;?></span>
  </div>
  <div class="input-group">
  Collezione: <input type="text" name="collezione" value="<?php echo $collezione;?>" size="60">
  <span class="error"> <?php echo $collezioneErr;?></span>
  </div>
<div class="input-group">
  Collezione #: <input type="text" name="collezione_nr" value="<?php echo $collezione_nr;?>" size="10">
  <span class="error"> <?php echo $collezioneErr;?></span>
  </div>
  <div class="input-group">
  Sezione: <input type="text" name="sezione" value="<?php echo $row_libri['sezione'];?>" size="60">
  </div>
  <div class="input-group">
  Gruppo: <input type="text" name="gruppo" value="<?php echo $row_libri['gruppo'];?>" size="60">
  </div>
  <div class="input-group">
  Pagine: <input type="text" name="pagine" value="<?php echo $pagine;?>" size="20">
  <span class="error">* <?php echo $pagineErr;?></span>
  </div>
  <div class="input-group">
  Altezza: <input type="text" name="altezza" value="<?php echo $altezza;?>" size="4">
  <span class="error">* <?php echo $altezzaErr;?></span>
  </div>
  <div class="input-group">
  ISBN: <input type="text" name="isbn" value="<?php echo $isbn;?>" size="60">
  <span class="error"> <?php echo $isbnErr;?></span>
  </div>
  <div class="input-group">
  url: <input type="url" name="url" value="<?php echo $url;?>" size="60">
  <span class="error"><?php echo $urlErr;?></span>
  </div>
  <div class="input-group">
  Copertina: <input type="text" name="copertina" placeholder="https://ucp.altervista.org/libri/copertine/" value="<?php echo $copertina;?>" size="60">
  <span class="error"><?php echo $copertinaErr;?></span>
  <br>https://ucp.altervista.org/libri/copertine/<br /></div>
  <div class="input-group">
  Posizione: <input type="text" name="posizione" value="<?php echo $row_libri['posizione'];?>" size="60">
  </div>
  <div class="input-group">
  Libreria: <input type="text" name="libreria" value="<?php echo $row_libri['libreria'];?>" size="60">
  </div>
  <div class="input-group">
  Data: <input type="text" name="data" value="<?php echo $row_libri['data'];?>">
  </div>
  <div class="input-group">
  Annotazioni: <textarea name="note" rows="5" cols="40"><?php echo $note;?></textarea>
  </div>
