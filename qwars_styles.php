<style type="text/css">

  /* ================================================  */
  /* TABEL  */
  /* ================================================  */
  td{
    /*padding: 3px 5px !important;*/
    /*color: white !important;*/
  }

  .judul_tabel { 
    background: linear-gradient(#00008899,#55005599); 
    text-align: center; 
    font-weight: bold; 
  }




  /* ================================================  */
  /* DEBUG  */
  /* ================================================  */
  .debug{
    color: blue;
    background: red;
    <?php if (!$dm) {
        echo "display: none";
    } ?>
  }

  .prototype{
    color: white !important;
    background: red;
    padding: 10px;
    border-radius: 10px;
  }

 

  /* ================================================  */
  /* COMMON  */
  /* ================================================  */
  .help{
    cursor: pointer;
    /*vertical-align: super;*/
    opacity: 0.8;
  }
  .help:hover{
    opacity: 1;
    border: solid 1px white;
  }

  .deletable,.detkel{
    cursor: pointer;
    background-color: #733;
  }
  .deletable:hover,.detkel:hover{
    background: linear-gradient(#f00,#f55);
  }
  .editable{
    cursor: pointer;
    background-color: #373;
  }
  .editable:hover{
    background: linear-gradient(#a4a,#444);
  }
  .wadah{
    border: solid 1px #777; border-radius: 10px; padding: 15px;
  }
  .img_wa{
    cursor: pointer;
  }
  .img_wa_disabled{
    cursor: not-allowed;
  }

  .red {color: red;}


  .zoom, .img_zoom, .link_zoom {
    transition: .2s;
  }

  .zoom:hover,.img_zoom:hover {
    transform: scale(1.2);
  }

  .link_zoom { color: darkblue !important; }
  .link_zoom:hover {
    letter-spacing: 1px;
  }






  
  /* =========================================== */
  /* BLOK UPLOAD */
  /* =========================================== */

  #blok_upload_profil{
    /* display: grid; */
    /* grid-template-columns: auto 100px; */
    /* grid-gap: 10px; */
  }

  .blok_input_profil{
    border: solid 1px #ccc;
    border-radius: 5px;
    padding: 5px;
    margin-bottom: 10px;
  }

  #blok_contoh_profil{
    display: flex;
  }

  .foto_profil{
    width: 100px;
    height: 100px;
    object-fit: cover;
    border-radius: 50%;
    border: solid 3px white;
    box-shadow: 0px 0px 3px gray;
    transition: .2s;
    margin: 10px;
    opacity: 75%;
    cursor: pointer;
  }

  .foto_profil:hover{
    transform: scale(1.2);
    -webkit-filter: grayscale(0%);
    filter: grayscale(0%);
    opacity: 100%;
  }

  #blok_contoh_profil{
    border: solid 1px #ccc;
    padding: 15px;
    border-radius: 10px;
    /*display: none;*/
  }

  #lihat_contoh{
    color: #379FE0;
    cursor: pointer;
    transition: .2s;
  }

  #lihat_contoh:hover{
    margin-left: 5px;
    letter-spacing: 1px;
    color: blue;
  }










  /* ========================================== */
  /* RADIO TOOLBAR */
  /* ========================================== */
  .radio-toolbar {
    /*margin: 10px;*/
    font-family: 'century gothic';
  }

  .radio-toolbar input[type="radio"] {
    opacity: 0;
    position: fixed;
    width: 0;
  }

  .radio-toolbar label {
      display: block;
      background-color: #dddd8888;
      padding: 10px 20px;
      font-family: sans-serif, Arial;
      font-size: 16px;
      border: 2px solid #444;
      border-radius: 4px;
      cursor: pointer;
      text-align: center;
  }

  .radio-toolbar label:hover {
    background-color: #dddd88ff;
    color: darkblue;
  }

  .radio-toolbar input[type="radio"]:focus + label {
      border: 2px dashed #444;
  }

  .radio-toolbar input[type="radio"]:checked + label {
      background-color: #8f8;
      border-color: #4c4;
      color: darkblue;
      font-weight: bold;
  }

  .radio-toolbar input[type="text"]:disabled{
    background: #dddd8888;
  }




  /* ========================================== */
  /* PLAYER INFO / LEADERBOARD */
  /* ========================================== */
  .row_leaderboard{
    cursor: pointer;
    transition: .2s;
  }
  .row_leaderboard:hover{
    letter-spacing: .8px;
  }









  /* ========================================== */
  /* LIST CHALLENGER */
  /* ========================================== */
  .gm_comment{
    color:yellow;
    cursor: pointer;
    transition: .3s;
    margin-top: 5px;
  }
  .gm_comment:hover{
    letter-spacing: .5px;
  }






  /* ========================================== */
  /* PLAYER DASHBOARD */
  /* ========================================== */
  .blok_dashboard a{
		color: #8ff;
		transition: .5s;
	}

	.blok_dashboard a:hover{
		letter-spacing: 1px;
		color: yellow;
	}

	.blok_progres{
		margin: 7px 0 15px 0;

	}

	.blok_rank{
		text-align: center;
		background: pink;
		padding: 10px 0;
		color: darkblue;
	}

	.row_dashboard{
		background: linear-gradient(#00ff0011, #ff00ff33);
		padding: 10px;
		cursor: pointer;
	}

	.row_dashboard:hover{
		background: linear-gradient(#00ff0033, #00ff0055);

	}

	.blok_rank, .row_dashboard{
		border: solid 1px #ccccff55;
	}
</style>