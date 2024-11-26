<?php 
  $dir = $_SERVER['DOCUMENT_ROOT'];
  include_once($dir."/components/config.php");
?>

<head>
  <link rel="stylesheet" href="<?php echo $base_url; ?>components/assets/country.css?v=<?php echo time(); ?>">
</head>

<div class="country">
  <div class="custom-select">
      <div class="select-selected">Selecione um país</div>
      <div class="select-items">
          <div data-value="af">
              <img class="flag" src="https://flagpedia.net/data/flags/h80/af.png" alt="Afeganistão"> Afeganistão - افغانستان‎
          </div>
          <div data-value="za">
              <img class="flag" src="https://flagpedia.net/data/flags/h80/za.png" alt="África do Sul"> África do Sul - South Africa
          </div>
          <div data-value="al">
              <img class="flag" src="https://flagpedia.net/data/flags/h80/al.png" alt="Albânia"> Albânia - Shqipëri
          </div>
          <div data-value="de">
              <img class="flag" src="https://flagpedia.net/data/flags/h80/de.png" alt="Alemanha"> Alemanha - Deutschland
          </div>
          <div data-value="sa">
              <img class="flag" src="https://flagpedia.net/data/flags/h80/sa.png" alt="Arábia Saudita"> Arábia Saudita - المملكة العربية السعودية
          </div>
          <div data-value="dz">
              <img class="flag" src="https://flagpedia.net/data/flags/h80/dz.png" alt="Argélia"> Argélia - الجزائر
          </div>
          <div data-value="ar">
              <img class="flag" src="https://flagpedia.net/data/flags/h80/ar.png" alt="Argentina"> Argentina - Argentina
          </div>
          <div data-value="am">
              <img class="flag" src="https://flagpedia.net/data/flags/h80/am.png" alt="Armênia"> Armênia - Հայաստան
          </div>
          <div data-value="au">
              <img class="flag" src="https://flagpedia.net/data/flags/h80/au.png" alt="Austrália"> Austrália - Australia
          </div>
          <div data-value="at">
              <img class="flag" src="https://flagpedia.net/data/flags/h80/at.png" alt="Áustria"> Áustria - Österreich
          </div>
          <div data-value="az">
              <img class="flag" src="https://flagpedia.net/data/flags/h80/az.png" alt="Azerbaijão"> Azerbaijão - Azərbaycan
          </div>
          <div data-value="bd">
              <img class="flag" src="https://flagpedia.net/data/flags/h80/bd.png" alt="Bangladesh"> Bangladesh - বাংলাদেশ
          </div>
          <div data-value="be">
              <img class="flag" src="https://flagpedia.net/data/flags/h80/be.png" alt="Bélgica"> Bélgica - België
          </div>
          <div data-value="bo">
              <img class="flag" src="https://flagpedia.net/data/flags/h80/bo.png" alt="Bolívia"> Bolívia - Bolivia
          </div>
          <div data-value="br">
              <img class="flag" src="https://flagpedia.net/data/flags/h80/br.png" alt="Brasil"> Brasil - Brasil
          </div>
          <div data-value="bg">
              <img class="flag" src="https://flagpedia.net/data/flags/h80/bg.png" alt="Bulgária"> Bulgária - България
          </div>
          <div data-value="kh">
              <img class="flag" src="https://flagpedia.net/data/flags/h80/kh.png" alt="Camboja"> Camboja - កម្ពុជា
          </div>
          <div data-value="cm">
              <img class="flag" src="https://flagpedia.net/data/flags/h80/cm.png" alt="Camarões"> Camarões - Cameroun
          </div>
          <div data-value="ca">
              <img class="flag" src="https://flagpedia.net/data/flags/h80/ca.png" alt="Canadá"> Canadá - Canada
          </div>
          <div data-value="qa">
              <img class="flag" src="https://flagpedia.net/data/flags/h80/qa.png" alt="Catar"> Catar - قطر
          </div>
          <div data-value="cl">
              <img class="flag" src="https://flagpedia.net/data/flags/h80/cl.png" alt="Chile"> Chile - Chile
          </div>
          <div data-value="cn">
              <img class="flag" src="https://flagpedia.net/data/flags/h80/cn.png" alt="China"> China - 中国
          </div>
          <div data-value="co">
              <img class="flag" src="https://flagpedia.net/data/flags/h80/co.png" alt="Colômbia"> Colômbia - Colombia
          </div>
          <div data-value="kp">
              <img class="flag" src="https://flagpedia.net/data/flags/h80/kp.png" alt="Coreia do Norte"> Coreia do Norte - 조선
          </div>
          <div data-value="kr">
              <img class="flag" src="https://flagpedia.net/data/flags/h80/kr.png" alt="Coreia do Sul"> Coreia do Sul - 대한민국
          </div>
          <div data-value="cu">
              <img class="flag" src="https://flagpedia.net/data/flags/h80/cu.png" alt="Cuba"> Cuba - Cuba
          </div>
          <div data-value="dk">
              <img class="flag" src="https://flagpedia.net/data/flags/h80/dk.png" alt="Dinamarca"> Dinamarca - Danmark
          </div>
          <div data-value="eg">
              <img class="flag" src="https://flagpedia.net/data/flags/h80/eg.png" alt="Egito"> Egito - مصر
          </div>
          <div data-value="ec">
              <img class="flag" src="https://flagpedia.net/data/flags/h80/ec.png" alt="Equador"> Equador - Ecuador
          </div>
          <div data-value="sk">
              <img class="flag" src="https://flagpedia.net/data/flags/h80/sk.png" alt="Eslováquia"> Eslováquia - Slovensko
          </div>
          <div data-value="si">
              <img class="flag" src="https://flagpedia.net/data/flags/h80/si.png" alt="Eslovênia"> Eslovênia - Slovenija
          </div>
          <div data-value="es">
              <img class="flag" src="https://flagpedia.net/data/flags/h80/es.png" alt="Espanha"> Espanha - España
          </div>
          <div data-value="us">
              <img class="flag" src="https://flagpedia.net/data/flags/h80/us.png" alt="Estados Unidos"> Estados Unidos - United States
          </div>
          <div data-value="ph">
              <img class="flag" src="https://flagpedia.net/data/flags/h80/ph.png" alt="Filipinas"> Filipinas - Pilipinas
          </div>
          <div data-value="fi">
              <img class="flag" src="https://flagpedia.net/data/flags/h80/fi.png" alt="Finlândia"> Finlândia - Suomi
          </div>
          <div data-value="fr">
              <img class="flag" src="https://flagpedia.net/data/flags/h80/fr.png" alt="França"> França - France
          </div>
          <div data-value="gr">
              <img class="flag" src="https://flagpedia.net/data/flags/h80/gr.png" alt="Grécia"> Grécia - Ελλάδα
          </div>
          <div data-value="gt">
              <img class="flag" src="https://flagpedia.net/data/flags/h80/gt.png" alt="Guatemala"> Guatemala - Guatemala
          </div>
          <div data-value="ht">
              <img class="flag" src="https://flagpedia.net/data/flags/h80/ht.png" alt="Haiti"> Haiti - Haïti
          </div>
          <div data-value="hn">
              <img class="flag" src="https://flagpedia.net/data/flags/h80/hn.png" alt="Honduras"> Honduras - Honduras
          </div>
          <div data-value="hu">
              <img class="flag" src="https://flagpedia.net/data/flags/h80/hu.png" alt="Hungria"> Hungria - Magyarország
          </div>
          <div data-value="in">
              <img class="flag" src="https://flagpedia.net/data/flags/h80/in.png" alt="Índia"> Índia - भारत
          </div>
          <div data-value="id">
              <img class="flag" src="https://flagpedia.net/data/flags/h80/id.png" alt="Indonésia"> Indonésia - Indonesia
          </div>
          <div data-value="ir">
              <img class="flag" src="https://flagpedia.net/data/flags/h80/ir.png" alt="Irã"> Irã - ایران
          </div>
          <div data-value="iq">
              <img class="flag" src="https://flagpedia.net/data/flags/h80/iq.png" alt="Iraque"> Iraque - العراق
          </div>
          <div data-value="ie">
              <img class="flag" src="https://flagpedia.net/data/flags/h80/ie.png" alt="Irlanda"> Irlanda - Éire
          </div>
          <div data-value="is">
              <img class="flag" src="https://flagpedia.net/data/flags/h80/is.png" alt="Islândia"> Islândia - Ísland
          </div>
          <div data-value="il">
              <img class="flag" src="https://flagpedia.net/data/flags/h80/il.png" alt="Israel"> Israel - ישראל
          </div>
          <div data-value="it">
              <img class="flag" src="https://flagpedia.net/data/flags/h80/it.png" alt="Itália"> Itália - Italia
          </div>
          <div data-value="jp">
              <img class="flag" src="https://flagpedia.net/data/flags/h80/jp.png" alt="Japão"> Japão - 日本
          </div>
          <div data-value="jo">
              <img class="flag" src="https://flagpedia.net/data/flags/h80/jo.png" alt="Jordânia"> Jordânia - الأردن
          </div>
          <div data-value="lb">
              <img class="flag" src="https://flagpedia.net/data/flags/h80/lb.png" alt="Líbano"> Líbano - لبنان
          </div>
          <div data-value="ly">
              <img class="flag" src="https://flagpedia.net/data/flags/h80/ly.png" alt="Líbia"> Líbia - ليبيا
          </div>
          <div data-value="my">
              <img class="flag" src="https://flagpedia.net/data/flags/h80/my.png" alt="Malásia"> Malásia - Malaysia
          </div>
          <div data-value="mx">
              <img class="flag" src="https://flagpedia.net/data/flags/h80/mx.png" alt="México"> México - México
          </div>
          <div data-value="mz">
              <img class="flag" src="https://flagpedia.net/data/flags/h80/mz.png" alt="Moçambique"> Moçambique - Moçambique
          </div>
          <div data-value="np">
              <img class="flag" src="https://flagpedia.net/data/flags/h80/np.png" alt="Nepal"> Nepal - नेपाल
          </div>
          <div data-value="no">
              <img class="flag" src="https://flagpedia.net/data/flags/h80/no.png" alt="Noruega"> Noruega - Norge
          </div>
          <div data-value="nz">
              <img class="flag" src="https://flagpedia.net/data/flags/h80/nz.png" alt="Nova Zelândia"> Nova Zelândia - New Zealand
          </div>
          <div data-value="pk">
              <img class="flag" src="https://flagpedia.net/data/flags/h80/pk.png" alt="Paquistão"> Paquistão - پاکستان
          </div>
          <div data-value="py">
              <img class="flag" src="https://flagpedia.net/data/flags/h80/py.png" alt="Paraguai"> Paraguai - Paraguay
          </div>
          <div data-value="pe">
              <img class="flag" src="https://flagpedia.net/data/flags/h80/pe.png" alt="Peru"> Peru - Perú
          </div>
          <div data-value="pl">
              <img class="flag" src="https://flagpedia.net/data/flags/h80/pl.png" alt="Polônia"> Polônia - Polska
          </div>
          <div data-value="pt">
              <img class="flag" src="https://flagpedia.net/data/flags/h80/pt.png" alt="Portugal"> Portugal - Portugal
          </div>
          <div data-value="ke">
              <img class="flag" src="https://flagpedia.net/data/flags/h80/ke.png" alt="Quênia"> Quênia - Kenya
          </div>
          <div data-value="gb">
              <img class="flag" src="https://flagpedia.net/data/flags/h80/gb.png" alt="Reino Unido"> Reino Unido - United Kingdom
          </div>
          <div data-value="cz">
              <img class="flag" src="https://flagpedia.net/data/flags/h80/cz.png" alt="República Tcheca"> República Tcheca - Česko
          </div>
          <div data-value="ro">
              <img class="flag" src="https://flagpedia.net/data/flags/h80/ro.png" alt="Romênia"> Romênia - România
          </div>
          <div data-value="ru">
              <img class="flag" src="https://flagpedia.net/data/flags/h80/ru.png" alt="Rússia"> Rússia - Россия
          </div>
          <div data-value="rs">
              <img class="flag" src="https://flagpedia.net/data/flags/h80/rs.png" alt="Sérvia"> Sérvia - Србија
          </div>
          <div data-value="sy">
              <img class="flag" src="https://flagpedia.net/data/flags/h80/sy.png" alt="Síria"> Síria - سوريا
          </div>
          <div data-value="lk">
              <img class="flag" src="https://flagpedia.net/data/flags/h80/lk.png" alt="Sri Lanka"> Sri Lanka - ශ්‍රී ලංකාව
          </div>
          <div data-value="se">
              <img class="flag" src="https://flagpedia.net/data/flags/h80/se.png" alt="Suécia"> Suécia - Sverige
          </div>
          <div data-value="ch">
              <img class="flag" src="https://flagpedia.net/data/flags/h80/ch.png" alt="Suíça"> Suíça - Schweiz
          </div>
          <div data-value="th">
              <img class="flag" src="https://flagpedia.net/data/flags/h80/th.png" alt="Tailândia"> Tailândia - ประเทศไทย
          </div>
          <div data-value="tr">
              <img class="flag" src="https://flagpedia.net/data/flags/h80/tr.png" alt="Turquia"> Turquia - Türkiye
          </div>
          <div data-value="ua">
              <img class="flag" src="https://flagpedia.net/data/flags/h80/ua.png" alt="Ucrânia"> Ucrânia - Україна
          </div>
          <div data-value="uy">
              <img class="flag" src="https://flagpedia.net/data/flags/h80/uy.png" alt="Uruguai"> Uruguai - Uruguay
          </div>
          <div data-value="va">
              <img class="flag" src="https://flagpedia.net/data/flags/h80/va.png" alt="Vaticano"> Vaticano - Città del Vaticano
          </div>
          <div data-value="ve">
              <img class="flag" src="https://flagpedia.net/data/flags/h80/ve.png" alt="Venezuela"> Venezuela - Venezuela
          </div>
          <div data-value="vn">
              <img class="flag" src="https://flagpedia.net/data/flags/h80/vn.png" alt="Vietnã"> Vietnã - Việt Nam
          </div>
          <div data-value="zm">
              <img class="flag" src="https://flagpedia.net/data/flags/h80/zm.png" alt="Zâmbia"> Zâmbia - Zambia
          </div>
      </div>
  </div>
</div>