/*
	ADMINISTRACIJA
*/
	DROP TABLE IF EXISTS admin_info;
	CREATE TABLE admin_info(
		idai int primary key auto_increment,
		email varchar(100) not null,
		registracija_info text,
		vefForma_info text,
		lista_info text,
		site_offline varchar(2) default 'da'
	)DEFAULT charset utf8;
	INSERT INTO admin_info(email, registracija_info, vefForma_info, lista_info) VALUES (
	"aleksandar.k03@gmail.com", /* email */
	"<b>Registracija info</b><br />
Podacima koje ovdje dostavite moći ćete jedino vi da pristupite nakon aktivacije vašen naloga. Molimo vas da podatke kao što su: korisničko ime, šifra, email, ime, prezime, datum rođenja unesete ispravno jer nakon registracije te podatke nećete moći da mijenjate. Nakon registracije dobićete mail sa adresom gdje treba da aktivirate nalog, kao i i vaše korisničko ime i šifru. Molimo vas da sačuvate taj mail jer ponovno slanje šifre ne postoji.<br />
Ukoliko vam nakon potvrde bude dolazila poruka da nešto nije urađeno ispravno, molimo vas da provjerite ili ponovo ukucate podatke vezane za vaš email i datum rođenja.", /* registracija_info */

	"<b>VefForma info</b><br />
VEF Forma ili 'Volunteer exchange form' jer forma koja je obavezna pri apliciranju za neki kamp. Prije slanja vaše liste kampova, sva pitanja moraju biti odgovorena!<br />
<b>Važno: </b>Molimo vas da odgovore na sva pitanja pišete na engleskom jeziku. Odgovori na sva pitanja se mogu mijenjati na stranici vašeg korisničkog naloga. Tokom registracije ne morate odgovarati na pitanja (u tom slučaju ostavite znak '-' kao odgovor), ali vas molimo da na sva pitanja odgovorite prije slanja liste kampova. Informacijama koje dostavite moći ćete da pristupite jedino vi, i osoba koja prima vašu listu kampova.", /* vefForma_info */
	
	"<b>Lista kampova</b><br />
Ovdje se nalazi vaša lista kampova. Kamp dodajete u listu tako što u stranici kampa kliknete na dugme Dodaj u listu, ili nešto tako. Da bi obrisali kamp iz liste morate opet da odete na stranicu tog kampa i da kliknete na dugme koje će objašnjavati svoju svrhu. Listu kampova šaljete tako što kliknete na dugme Pošalji listu kampova, koje se nalazi u gornjem desnom uglu. Morate imati minimum 4 kampa u listi kako bi izvršili ovu operaciju. Lista vaših kampova zajedno sa odgovorima na pitanja VEF forme će biti poslati osobi koja je zadužena za te stvari, i ona će vam se najvjerovatnije javiti ili nešto slično." /* lista_info */
	);
/*
	CLAN
*/
	DROP TABLE IF EXISTS clan;
	CREATE TABLE clan(
		idc int primary key auto_increment,
		username varchar(10) not null, 
		sifra varchar(20) not null,
		email varchar(40) not null,
		ime varchar(15) not null,
		prezime varchar(15) not null,
		danRodjenja int not null,
		mjesecRodjenja int not null,
		godinaRodjenja int not null,
		pol char not null,
		mjestoStanovanja varchar(20) not null,
		kontakt_telefon varchar(20) default '-',
		jedinstvenaSifra varchar(32) default "SRBIJA",
		status varchar(3) default "ne", /* [da, ne, ban] [aktivan, neaktivan, banovan] */
		admin_level varchar(2) default 'ko', /* [ko, ad] [korisnik, admin] */
		/* VEF */
		zanimanje varchar(50) default '',
		zdrastvene_napomene text default '',
		jezik varchar(50) default '',
		nacionalnost varchar(50) default '',
		broj_pasosa varchar(50) default '',
		pasos_kadaIzdat varchar(50) default '',
		pasos_doKadTraje varchar(50) default '',
		ime_roditelja varchar(50) default '',
		predhodno_iskustvo text default '',
		zbog_cega text default '',
		opste_napomene text,
		preuzmi_drugiKamp  varchar(3) default 'Yes'
	)DEFAULT charset utf8;
	INSERT INTO clan(username, sifra, email, ime, prezime, danRodjenja, mjesecRodjenja, godinaRodjenja, pol, mjestoStanovanja, jedinstvenaSifra, status, admin_level,
					 zanimanje, zdrastvene_napomene, jezik, nacionalnost, broj_pasosa, pasos_kadaIzdat, pasos_doKadTraje, ime_roditelja, predhodno_iskustvo, zbog_cega) VALUES(
		"admin", /*username */
		"admincina", /*sifra */
		"logaritam@gmail.com", /*email */
		"dr Assantar", /*ime */
		"Kolreak", /*prezime */
		7, /*danRodjenja */
		10, /*mjesecRodjenja */
		1992, /*godinaRodjenja */
		"m", /*pol */
		"Cuba, Havana", /*mjestoStanovanja */
		"Nista za sad", /*Jedinstveni broj */
		"da", /* status */
		"ad", /* admin_level */
		/* VEF */
		"zanimanje", /* zanimanje */
		"zdrastvene_napomeene", /* zdrastvene_napomene */
		"jezik", /* jezik */
		"nacionalnost", /* nacionalnost */
		"broj_pasosa", /* broj_pasosa */
		"pasos_kadaIzdat", /* pasos_kadaIzdat */
		"pasos_doKadTraje", /* pasos_doKadTraje */
		"ime_roditelja", /* ime_roditelja */
		"predhodno_iskustvo", /* predhodno_iskustvo */
		"zbog cega" /* zbog_cega */
	);
	INSERT INTO clan(username, sifra, email, ime, prezime, danRodjenja, mjesecRodjenja, godinaRodjenja, pol, mjestoStanovanja, jedinstvenaSifra, status, admin_level,
					 zanimanje, zdrastvene_napomene, jezik, nacionalnost, broj_pasosa, pasos_kadaIzdat, pasos_doKadTraje, ime_roditelja, predhodno_iskustvo, zbog_cega) VALUES(
		"aco228", /*username */
		"aco1234", /*sifra */
		"logaritam@gmail.com", /*email */
		"Aleksandar", /*ime */
		"Konatar", /*prezime */
		7, /*danRodjenja */
		10, /*mjesecRodjenja */
		1992, /*godinaRodjenja */
		"m", /*pol */
		"Podgorica", /*mjestoStanovanja */
		"Nista za sad", /*Jedinstveni broj */
		"da", /* status */
		"ad", /* admin_level */
		/* VEF */
		"Privrednik", /* zanimanje */
		"zdrastvene_napomeen", /* zdrastvene_napomene */
		"Kineski", /* jezik */
		"Sovjet", /* nacionalnost */
		"broj_pasosa", /* broj_pasosa */
		"pasos_kadaIzdat", /* pasos_kadaIzdat */
		"pasos_doKadTraje", /* pasos_doKadTraje */
		"Taksi", /* ime_roditelja */
		"predhodno_iskustvo", /* predhodno_iskustvo */
		"zbog cega" /* zbog_cega */
	);

/*
	NOVOST
*/
	DROP TABLE IF EXISTS novost;
	CREATE TABLE novost(
		idn int primary key auto_increment,
		naslov varchar(30) not null,
		opis varchar(130) not null,
		tekst text not null,
		koristi_novost varchar(2) default 'da',
		adresa_slike text not null,
		server_slika varchar(2) not null,
		autor varchar(10) not null,
		datumDan int not null,
		datumMjesec int not null,
		datumGodina int not null
	)DEFAULT charset utf8;
	INSERT INTO novost(naslov, opis, tekst, adresa_slike, server_slika, autor, datumDan, datumMjesec, datumGodina) VALUES(
		"Стефан Душан", /*naslov */
		
		"Стефан Урош IV Душан Немањић, познат и као Душан Силни (око 1308 — 20. децембар 1355) је био српски средњовековни краљ (1331 — 1345) и први српски цар (1346 — 1355). Био је син краља Стефана Уроша III Дечанског и отац цара Стефана Уроша V, у народу прозваног Нејаким, последњег владара из династије Немањића.", /*opis */
		
		"Стефан Урош IV Душан Немањић, познат и као Душан Силни (око 1308 — 20. децембар 1355) је био српски средњовековни краљ (1331 — 1345) и први српски цар (1346 — 1355). Био је син краља Стефана Уроша III Дечанског и отац цара Стефана Уроша V, у народу прозваног Нејаким, последњег владара из династије Немањића. Душан је са власти збацио свог оца Стефана Дечанског, уз помоћ властеле незадовољне политиком Стефана Дечанског према Бугарској и Византији, након битке код Велбужда. Душан је значајно проширио границе српске државе према југу, све до Коринтског залива, искористивши унутрашње немире у Византији. По освајању великих византијских територија Стефан Душан се 1345. прогласио за цара Срба, Грка (тј. Ромеја) и Бугара, српску цркву је са ранга архиепископијe је уздигао на ранг патријаршије, да би га први српски патријарх Јоаникије 1346. крунисао. Познат је и по доношењу Душановог законика, најзначајнијег српског средњовековног правног акта. Завршио је манастир Дечане, задужбину свога оца, а његова најзначајнија задужбина био је Манастир Светих архангела код Призрена, где се налазио и његов гроб. Без обзира на то, Стефан Душан је једини владар из династије Немањића који није био проглашен за свеца после смрти.Опеван је у народним песмама, али га народ није нарочито волео. Његова круна се држи у Цетињском манастиру у Црној Гори.", /*tekst */

		"https://upload.wikimedia.org/wikipedia/commons/4/4c/Car_Du%C5%A1an%2C_Manastir_Lesnovo%2C_XIV_vek%2C_Makedonija.jpg", /*adresa_slike */
		"ne", /*server_slika */
		"admin", /*autor */
		4, /*datumDan */
		12, /*datumMjesec */
		2012 /*datumGodina */
	);
	INSERT INTO novost(naslov, opis, tekst, adresa_slike, server_slika, autor, datumDan, datumMjesec, datumGodina) VALUES(
		"Че Гевара", /*naslov */
		
		"Ернесто Гевара де ла Серна, познатији као Че Гевара или само Че (шп. Ernesto Guevara de la Serna, Che; Росарио, 14. мај 1928 — Ла Игера, 9. октобар 1967) је био је марксистички револуционар, кубански герилски вођа и теоретичар, лекар, дипломата и писац.", /*opis */
		
		"Гевара је представљао једну од кључних личности у револуцији Фидела Кастра на Куби (1956–1959), као члан покрета „26. јул“. Након победе револуције, неколико година је био активан у промоцији револуције друштва, путујући по свету као дипломата Кубе, а затим се лично ангажовао у покретима за ослобођење од диктаторских режима путем герилске борбе, најпре у Конгу, за време владавине Моиза Чомбеа, а потом у Боливији. У Боливији, спрегом Америчке обавештајне агенције и боливијске војске, Гевара је најпре ухваћен, а одмах сутрадан убијен. Његов лик, као борца за ослобођење и жртве империјализма, и данас, неколико деценија после његове смрти, представља један од главних симбола и икона друштвене и политичке револуције широм света.[1][2][3] Као строг војсковођа, и потпуно посвећен свом револуционарном циљу са огромним моралним ауторитетом над својим трупама,[4] он је остао контроверзна личност од велике историјске важности.

	Часопис „Тајм“ прогласио је Гевару једним од 20 највећих светских икона и хероја у оквиру 100 најутицајнијих људи света 20. века,[5] а чувену фотографију Геваре (десно), коју је начинио Алберто „Корда“ Дијаз, Академија уметности у Мериленду прогласила је „најпознатијом фотографијом на свету и симболом двадесетог века“.[6]", /*tekst */

		"https://upload.wikimedia.org/wikipedia/commons/5/58/CheHigh.jpg", /*adresa_slike */
		"ne", /*server_slika */
		"admin", /*autor */
		4, /*datumDan */
		12, /*datumMjesec */
		2012 /*datumGodina */
	);
	INSERT INTO novost(naslov, opis, tekst, adresa_slike, server_slika, autor, datumDan, datumMjesec, datumGodina) VALUES(
		"Ian Curtis of Joy Division", /*naslov */
		
		"Ian Kevin Curtis (15 July 1956 — 18 May 1980) was an English musician, best known as the lead singer and lyricist of the post-punk band Joy Division. ", /*opis */
		
		"Ian Kevin Curtis (15 July 1956 — 18 May 1980) was an English musician, best known as the lead singer and lyricist of the post-punk band Joy Division. Joy Division released their debut album, Unknown Pleasures, in 1979 and recorded their follow-up, Closer, in 1980. Curtis, who suffered from epilepsy and depression, committed suicide on 18 May 1980, on the eve of Joy Division's first North American tour, resulting in the band's dissolution and the subsequent formation of New Order.
	Curtis was known for his baritone voice, dance style, and songwriting filled with imagery of desolation, emptiness and alienation.
	In 1995, Curtis' widow Deborah published Touching from a Distance: Ian Curtis and Joy Division, a biography of the singer. His life and death have been dramatised in the films 24 Hour Party People (2002) and Control (2007).", /*tekst */

		"http://3.bp.blogspot.com/-gBE1t8KaJgY/TXEXH2AYKOI/AAAAAAAAC-w/EHuwrG_E3uo/s1600/ian12-12.jpg", /*adresa_slike */
		"ne", /*server_slika */
		"admin", /*autor */
		4, /*datumDan */
		12, /*datumMjesec */
		2012 /*datumGodina */
	);
	INSERT INTO novost(naslov, opis, tekst, adresa_slike, server_slika, autor, datumDan, datumMjesec, datumGodina) VALUES(
		"Kurt Cobain of Nirvana", /*naslov */
		
		"Kurt Donald Cobain (February 20, 1967 – April 5, 1994)[2][3] was an American musician and artist ", /*opis */
		
		"Kurt Donald Cobain (February 20, 1967 – April 5, 1994)[2][3] was an American musician and artist, best known as the lead singer, guitarist and primary songwriter of the grunge band Nirvana. Cobain formed Nirvana with Krist Novoselic in Aberdeen, Washington in 1985 and established it as part of the Seattle music scene, having its debut album Bleach released on the independent record label Sub Pop in 1989.
	After signing with major label DGC Records, the band found breakthrough success with \"Smells Like Teen Spirit\" from its second album Nevermind (1991). Following the success of Nevermind, Nirvana was labeled \"the flagship band\" of Generation X, and Cobain hailed as \"the spokesman of a generation\".[4] Cobain, however, was often uncomfortable and frustrated, believing his message and artistic vision to have been misinterpreted by the public, with his personal issues often subject to media attention. He challenged Nirvana's audience with its final studio album In Utero (1993).
	During the last years of his life, Cobain struggled with heroin addiction, illness and depression. He also had difficulty coping with his fame and public image, and the professional and lifelong personal pressures surrounding himself and his wife, musician Courtney Love. On April 8, 1994, Cobain was found dead at his home in Seattle, the victim of what was officially ruled a suicide by a self-inflicted shotgun wound to the head. The circumstances of his death at age 27 have become a topic of public fascination and debate. Since their debut, Nirvana, with Cobain as a songwriter, has sold over 25 million albums in the U.S., and over 50 million worldwide.[5][6]", /*tekst */

		"http://tvxs.gr/sites/default/files/article/2011/07/32036-kurt.jpg", /*adresa_slike */
		"ne", /*server_slika */
		"admin", /*autor */
		4, /*datumDan */
		12, /*datumMjesec */
		2012 /*datumGodina */
	);
	INSERT INTO novost(naslov, opis, tekst, adresa_slike, server_slika, autor, datumDan, datumMjesec, datumGodina) VALUES(
		"People are strange", /*naslov */
		
		"James Douglas \"Jim\" Morrison (December 8, 1943 – July 3, 1971) was an American singer-songwriter and poet,  ", /*opis */
		
		"James Douglas  Morrison (December 8, 1943 – July 3, 1971) was an American singer-songwriter and poet, best remembered as the lead singer of Los Angeles rock band The Doors.[1] Following The Doors' explosive rise to fame in 1967, Morrison developed an alcohol dependency which led to his death at the age of 27 in Paris. He is alleged to have died of a heroin overdose, but as no autopsy was performed, the exact cause of his death is still disputed, as well as rumors floating of him faking his own death to escape the pressures of fame.[2] Morrison was well known for often improvising spoken word poetry passages while the band played live. Due to his wild personality and performances, he is regarded by critics and fans as one of the most iconic, charismatic, and pioneering frontmen in rock music history.[3] Morrison was ranked number 47 on Rolling Stone's list of the [4] and number 22 on Classic Rock Magazine's [5]", /*tekst */

		"http://www.total-manga.com/images/Article/FR-3-51276-B/jim-morisson-le-mythique-chanteur-de-the-doors.jpg", /*adresa_slike */
		"ne", /*server_slika */
		"admin", /*autor */
		4, /*datumDan */
		12, /*datumMjesec */
		2012 /*datumGodina */
	);
	INSERT INTO novost(naslov, opis, tekst, adresa_slike, server_slika, autor, datumDan, datumMjesec, datumGodina) VALUES(
		"Стив Џобс", /*naslov */
		
		"Стивен Пол Џобс (енгл. Steven Paul Jobs; 24. фебруар 1955 — 5. октобар 2011) је био један од оснивача и главни руководилац Епла. ", /*opis */
		
		"Такође је био једно време руководилац Пиксара све док није био продат Дизнију.[1] Такође је један од највећих деоничара Дизнија и члан Дизнијеве управе. Сматран је једном од водећих личности у индустрији рачунара и забаве.

	Џобсова пословна биографија је доста допринела миту о усамљеним, предузетницима особењацима Силицијумске долине, наглашавајући његово схватање значаја естетике и дизајна у јавности. Његов рад на производима који су били функционални и привлачни створио му је култни статус.

	Заједно са суоснивачем Епла Стивом Вознијаком допринео је ширењу популарности личних рачунара у касним седамдесетим годинама 20. века. Почетком осамдесетих, Џобс је први уочио комерцијални потенцијал графичког корисничког окружења и миша.[2] Након што је изгубио контролу у управи Епла 1985, Џобс је основао фирму Некст (енгл. NeXT), која се бавила рачунарским платформама специјализованим за високо образовање и пословну примену. Када је 1997. Епл купио Некст, Џобс се вратио у предузеће које је основао да би обављао функцију генералног директора све до повлачења и смрти 2011. године.", /*tekst */

		"http://blogs-images.forbes.com/connieguglielmo/files/2012/11/Steve-Jobs-dates.jpg", /*adresa_slike */
		"ne", /*server_slika */
		"admin", /*autor */
		4, /*datumDan */
		12, /*datumMjesec */
		2012 /*datumGodina */
	);
	INSERT INTO novost(naslov, opis, tekst, adresa_slike, server_slika, autor, datumDan, datumMjesec, datumGodina, koristi_novost) VALUES(
		"Tutorial koriscenja sajta", /*naslov */
		
		"Bez opisa", /*opis */
		
		"<b>Razrada</b>

Posto nemam pojma kako da napisem ovaj tutorial, onda cu koristiti poznatu tehniku sbrda-sdola;
Najvaznija stvar je Admin Sekcija. Da bi joj pristupili morate da se ulogujete i da imate admin privilegije. Oni kojima sam namjenio ovaj tutorial ce dobiti te informacije, ostali cao.
Nakon sto se ulogujete, u gornjem desno uglu ce pisati ime naloga na koji ste se ulogovali. Klikom na njega ulazite u vas \'profil\'. On je bio zamisljen da ima vise funkcija na sajtu, ali posto za njima nije bilo potrebe onda je ostao takav kakav je ostao. 
Na tom profilu, opet gornji desni ugao nalazi se dugme \'admin sekcija\'. Tu se nalaze sva podasavanja i opcije za dodavanje novih stvari.

<b>Dodaj novost</b>
Sva polja bi trebala da sama za sebe govore za sta sluze. Najvaznije je ukapirati sledece.
Kada postavljate novost morate postaviti neku sliku (kao recimo Rembrant na ovoj novost). Medjutim onaj koji postavlja tu novost moze da bira, da li zeli da postavi neku sliku sa interneta preko polja \"Internet slika\" (recimo slika sa Googla), ili zeli da uplouduje sliku sa kompjutera (polje \"Slika sa kompjutera\", logicno). Jako bitno upozorenje koje cu mozda jos koji put ponoviti. Kada uploudujete sliku sa kompjutera, neka vam orijentir bude neka velicina do 500kb. Sve preko toga ne valja. Razlog je ucitavanje, usporavanje kompletne stranice, i prostor na serveru. Oko toga vodite racuna.
Kao sto sam rekao, korisnik sam bira da li zeli da postavi sliku sa interneta ili sliku sa kompjutera. Jednu od te dvije opcije mora da izabere. Ako postavljate sliku sa kompjutera, ono polje koje se odnosi na sliku sa interneta ostavljate prazno, i obratno.

Sledeca bitna stvar je polje \"Koristi novost\";
To znaci sledece. Ako je polje strikirano, novost koju postavljate ce se nalaziti u sekciji novosti, na pocetnoj stranici. Medjutim ako ne strikirate to polje, novost se nece pojavljivati na indexu (u onoj grupi od poslednjih 6 vijesti), niti u Novostima.
Razlog je taj da korisnik (korisnik= onaj koji ce sve ovo da radi) moze da koristi tu novost kao sub meni u \"Projektima\" a ne zeli da se ta stranica tretira kao novost. Recimo ova stranica ce koristiti ovu opciju (nece je moci naci u novostima niti u poslednjim novostima na indeksu).(Mislim da sa ovim nisam bio jasan, al nema veze).
Ono sto je jaaaaaako bitno kod ovoga, ako ne strikirate ovo polje, a ne zapamtite njegov link, onda mu ne mozete nikako pristupiti (sem ako mu se opet nekako sjetite linka). Zbog toga ce vam nakon svakog dodavanja novosti na vrhu biti link prema toj novosti koji ako vec hocete da koristite ovu opciju, morate zapamtiti.

Sto se tice \"Teksta poruke\", tu stavljate tekst poruke :) (Sad vidim da je tu trebalo da stoji tekst novosti ili slicno)
Ovdje mozete da koristi html tagova za boldovana slova(< b >, < / b >), linkove(< a href=\"\" > < / a >), italik i slicno. Mogao sam ovo da napravim da radi automatski, ali je jako dosadan posao, pa ko bude postavljao novost neka nauci par ovih tagova.

I za kraj ono sto sam trebao da kazem na pocetku. Ime novosti znate za sta sluzi. Opis je obavezan (recimo prva recenica teksta), i on ce uvjek se nalaziti ispod naslova, na svim stranicama vezanim za novosti.

<b>Dodaj kamp</b>
Sto se tice dodavanja kampova, procitajte opet \"Dodaj novost\" sto sam pisao gore, i bice sve jasno.
Da. Jedina interesantna stvar je ovo \"Izbrisi neaktivne kampove\". U sustini on posmatra da li je se neki kamp zavrsio na osnovu datuma i ako nadje takve pokazace vam u zagradama broj (iliti koliko ih ima). Klikom na pomenuto dugme cete moci te iste nekativne kampove da izbrisete iz baze.

<b>Korisnici</b>
Ovo kulirajte sem ako nekog ko se registrovao na sajt zelite da postavite kao admina, ili zelite da ga banujete, fore radi. Osim toga nema nikakvih funkcija.

<b>Slike sa pocetne</b>
Ovdje ce biti izlistane sve slike koje se vrte na pocetnoj stranici. Mozete da ih brisete i dodadajete. Sto se tice dodavanja, opet cu ponovit (mada mislim da sam i eksplicitno zabranio na serveru) nemojte da stavljate velike slike. Ovo se posebno odnosi na Anu, ako ovo cita. One slike koje si mi dala preko fleske, svaka je bila preko megabajt. Sada ako ih dodas 10-tak, to ce biti 10megabajta koje neko mora da skine da bi ucitao index stranicu. Dakle za takve situacije koristi photoshop ili nesto da smanjis sliku na nekih 100-200-500kb i postavis je.

<b>Index meni</b>
Ovdje se nalaze svi linkovi koje cete pronaci u gornjem meniju \'Projekti\', i na index stranici. Kao sto vidite, stranica ima tri plava pravougaonika na kojima pise \"Prvi/Drugi/Treci naslov\", i ispod idu informacije.
Bitno je sledece. Prva tri polja oznacavaju Naslov, opis, i link (kada odete na index, ispod svakog velikog naslova vidjecete \'opsirnije\'. Onda ovu informaciju povezite sa onim \'link\' prije zagrade).
Ispod ta tri polja nalaze se njegovi sub-meniji. Logika je slicna, lijevo je naslov sub-menija, desno njegov link. Ako obrisete lijevu ili desnu stranu, kompletan taj link ce biti izbrisan. Klikom na dodaj link se dodaje link, sto je donekle i logicno.
Kada kliknete \'sacuvaj\' on ce ponovo ucitati stranicu i vidjecete da li je sve to sto ste radili sacuvano.

<b>Drzave svijeta</b>
... su tu jer ne znam koje su tacno potrebne. Tu mozete da dodajete nove i brisete postojece. One su bitne zbog kampova.

<b>Kontakt podesavanja</b>
Tu se nalazi mail na koji ce ici informacije ako neko ispuni VEF formu.

<b>Jos ponesto</b>
Novost mozete da brisete ako ste ulogovani kao admin, i udjete u tu stranicu, sa desno strane ce pisati \'Izbrisi\';
Vodite racuna kada iz \'Index menija\' brisete sub-menije, jer ako obriste neku novost koja \'se ne koristi kao novost\' (citaj ponovo dodavanje novosti), ili linkove kao sto su <a href=\"vefForma.php\">Vef forma</a> ili <a href=\"pretragaKampova.php\">Pretraga kampova</a>, onda da bi ih vratili morate se sjetiti njihove URL adrese;
Ukoliko zelite da promjenite kontakt informacije koje se nalaze na dnu stranice, onda morate iz \'engine/sekcije/_kontakt_futer.php\' da promjenite to sto vas zanima.
Ostalo bi sve trebalo da bude jasno.", /*tekst */

		"http://www.novosti.rs/upload/images/2013//03/27n/01-rembrant.jpg", /*adresa_slike */
		"ne", /*server_slika */
		"admin", /*autor */
		1, /*datumDan */
		5, /*datumMjesec */
		2012, /*datumGodina */
		'ne' /* koristi_novost */
	);
	INSERT INTO novost(naslov, opis, tekst, adresa_slike, server_slika, autor, datumDan, datumMjesec, datumGodina, koristi_novost) VALUES(
		"Volonterski kampovi u svetu", /*naslov */
		
		"To što nemaš debeli novčanik, pasoš i bogate rođake u inostranstvu, ne znači da i ovo leto treba da sediš kod kuće i ogovaraš one ", /*opis */
		
		"(Preuzeto sa sajta <a href=\"http://www.mis.org.rs/\">Mladi istrazivaci Srbije</a>)

To što nemaš debeli novčanik, pasoš i bogate rođake u inostranstvu, ne znači da i ovo leto treba da sediš kod kuće i ogovaraš one koji su otputovali.

Tvoje je samo da odgovoriš na sledeća pitanja, a ima ko će da organizuje tvoje letovanje!

Ovog leta želim da:

1. upoznam neke druge mirise, zvuke, mesta, događaje i ljude
2. naučim sasvim nove veštine
3. obnovim znanje stranog jezika
4. steknem prijatelje iz celog sveta
5. doprinesem da Zemlja postane zdravije i pravednije mesto", /*tekst */

		"http://www.operationworld.org/files/ow/flags/cu-lgflag.gif", /*adresa_slike */
		"ne", /*server_slika */
		"admin", /*autor */
		1, /*datumDan */
		5, /*datumMjesec */
		2012, /*datumGodina */
		'ne' /* koristi_novost */
	);

/*
	INDEKS
*/
	DROP TABLE IF EXISTS indeks_admin;
	CREATE TABLE indeks_admin(
		idia int primary key auto_increment,
		prvi_naslov varchar(30) not null,
		prvi_tekst varchar(150) not null,
		prvi_link varchar(50) not null,
		drugi_naslov varchar(30) not null,
		drugi_tekst varchar(150) not null,
		drugi_link varchar(50) not null,
		treci_naslov varchar(30) not null,
		treci_tekst varchar(150) not null,
		treci_link varchar(50) not null
	)DEFAULT charset utf8;
	INSERT INTO indeks_admin(prvi_naslov, prvi_tekst, prvi_link, drugi_naslov, drugi_tekst, drugi_link, treci_naslov, treci_tekst, treci_link) VALUES(
		"Tutorial sajta", /*prvi_naslov*/
		"Kratak tutorijal kako se koristi sajt :)", /*prvi_tekst*/
		"novost.php?novost=7",  /*prvi_link*/
		"Volonterski kampovi", /*drugi_naslov*/
		"To što nemaš debeli novčanik, pasoš i bogate rođake u inostranstvu, ne znači da i ovo leto treba da sediš kod kuće i ogovaraš one koji su otputovali.", /*drugi_tekst*/
		"novost.php?novost=8",  /*drugi_link*/
		"Јохан Волфганг фон Гете", /*treci_naslov*/
		"Јохан Волфганг фон Гете (нем. Johann Wolfgang von Goethe; Франкфурт на Мајни, 28. август 1749 — Вајмар, 22. март 1832)", /*treci_tekst*/
		"https://sr.wikipedia.org/wiki/%D0%88%D0%BE%D1%85%D0%B0%D0%BD_%D0%92%D0%BE%D0%BB%D1%84%D0%B3%D0%B0%D0%BD%D0%B3_%D0%93%D0%B5%D1%82%D0%B5"  /*treci_link*/
	);
/* MENU SA INDEXA */
	DROP TABLE IF EXISTS indeks_menu;
	CREATE TABLE indeks_menu(
		idim int primary key auto_increment,
		pripadnost int not null,
		naslov varchar(50) not null,
		link varchar(50) not null
	)DEFAULT charset utf8;
	INSERT INTO indeks_menu (pripadnost, naslov, link) VALUES ( 2, "Pretraga kampova", "pretragaKampova.php" );
	INSERT INTO indeks_menu (pripadnost, naslov, link) VALUES ( 2, "Forma razmjene volontera", "vefForma.php" );
	INSERT INTO indeks_menu (pripadnost, naslov, link) VALUES ( 2, "Kamp Pljevlja", "kamp.php?id=2" );
	INSERT INTO indeks_menu (pripadnost, naslov, link) VALUES ( 2, "Kamp Zabljak", "kamp.php?id=3" );
	INSERT INTO indeks_menu (pripadnost, naslov, link) VALUES ( 2, "Creative Team Niksic", "kamp.php?id=4" );
	INSERT INTO indeks_menu (pripadnost, naslov, link) VALUES ( 1, "Ce Guevara", "novost.php?novost=2" );
	INSERT INTO indeks_menu (pripadnost, naslov, link) VALUES ( 3, "Google", "http://www.google.com" );
	INSERT INTO indeks_menu (pripadnost, naslov, link) VALUES ( 3, "PMF", "http://www.pmf.ac.me" );
	INSERT INTO indeks_menu (pripadnost, naslov, link) VALUES ( 1, "Bezvezan link", "#" );
	INSERT INTO indeks_menu (pripadnost, naslov, link) VALUES ( 1, "Drugi bezvezni link", "#" ); 
	INSERT INTO indeks_menu (pripadnost, naslov, link) VALUES ( 1, "Najbezvezniiji link do sad", "#" );

/*
	ZEMLJE
*/
	DROP TABLE IF EXISTS zemlje;
	CREATE TABLE zemlje(
		idz int primary key auto_increment,
		ime_zemlje varchar(25) not null,
		jezik_zemlje varchar(20)
	)DEFAULT charset utf8;
	INSERT INTO zemlje (ime_zemlje, jezik_zemlje) VALUES( "Afghanistan", "AFG" );
	INSERT INTO zemlje (ime_zemlje, jezik_zemlje) VALUES( "Azerbaijan", "AZE" );
	INSERT INTO zemlje (ime_zemlje, jezik_zemlje) VALUES( "Albania", "ALB" );
	INSERT INTO zemlje (ime_zemlje, jezik_zemlje) VALUES( "Andorra", "AND" );
	INSERT INTO zemlje (ime_zemlje, jezik_zemlje) VALUES( "Angola", "AGO" );
	INSERT INTO zemlje (ime_zemlje, jezik_zemlje) VALUES( "Argentina", "ARG" );
	INSERT INTO zemlje (ime_zemlje, jezik_zemlje) VALUES( "Austria", "AUT" );
	INSERT INTO zemlje (ime_zemlje, jezik_zemlje) VALUES( "Australia", "AUS" );
	INSERT INTO zemlje (ime_zemlje, jezik_zemlje) VALUES( "Belarus", "BLR" );
	INSERT INTO zemlje (ime_zemlje, jezik_zemlje) VALUES( "Belgium", "BEL" );
	INSERT INTO zemlje (ime_zemlje, jezik_zemlje) VALUES( "Bosnia and Herzegovina", "BIH" );
	INSERT INTO zemlje (ime_zemlje, jezik_zemlje) VALUES( "Brazil", "BRA" );
	INSERT INTO zemlje (ime_zemlje, jezik_zemlje) VALUES( "Bulgaria", "BGR" );
	INSERT INTO zemlje (ime_zemlje, jezik_zemlje) VALUES( "Canada", "CAN" );
	INSERT INTO zemlje (ime_zemlje, jezik_zemlje) VALUES( "China", "CHN" );
	INSERT INTO zemlje (ime_zemlje, jezik_zemlje) VALUES( "Croatia", "HRV" );
	INSERT INTO zemlje (ime_zemlje, jezik_zemlje) VALUES( "Cuba", "CUB" );
	INSERT INTO zemlje (ime_zemlje, jezik_zemlje) VALUES( "Cyprus", "CYP" );
	INSERT INTO zemlje (ime_zemlje, jezik_zemlje) VALUES( "Denmark", "DNK" );
	INSERT INTO zemlje (ime_zemlje, jezik_zemlje) VALUES( "Estonia", "EST" );
	INSERT INTO zemlje (ime_zemlje, jezik_zemlje) VALUES( "Egypt", "EGY" );
	INSERT INTO zemlje (ime_zemlje, jezik_zemlje) VALUES( "Finland", "FIN" );
	INSERT INTO zemlje (ime_zemlje, jezik_zemlje) VALUES( "France", "FRA" );
	INSERT INTO zemlje (ime_zemlje, jezik_zemlje) VALUES( "Georgia", "GEO" );
	INSERT INTO zemlje (ime_zemlje, jezik_zemlje) VALUES( "Germany", "DEU" );
	INSERT INTO zemlje (ime_zemlje, jezik_zemlje) VALUES( "Greece", "GRC" );
	INSERT INTO zemlje (ime_zemlje, jezik_zemlje) VALUES( "Hungary", "HUN" );
	INSERT INTO zemlje (ime_zemlje, jezik_zemlje) VALUES( "Iceland", "ISL" );
	INSERT INTO zemlje (ime_zemlje, jezik_zemlje) VALUES( "India", "IND" );
	INSERT INTO zemlje (ime_zemlje, jezik_zemlje) VALUES( "Italy", "ITA" );
	INSERT INTO zemlje (ime_zemlje, jezik_zemlje) VALUES( "Kazakhstan", "KAZ" );
	INSERT INTO zemlje (ime_zemlje, jezik_zemlje) VALUES( "Japan", "JAP" );
	INSERT INTO zemlje (ime_zemlje, jezik_zemlje) VALUES( "Israel", "ISR" );
	INSERT INTO zemlje (ime_zemlje, jezik_zemlje) VALUES( "Ireland", "IRL" );
	INSERT INTO zemlje (ime_zemlje, jezik_zemlje) VALUES( "Liechtenstein", "LIE" );
	INSERT INTO zemlje (ime_zemlje, jezik_zemlje) VALUES( "Lithuania", "LTU" );
	INSERT INTO zemlje (ime_zemlje, jezik_zemlje) VALUES( "Luxembourg", "LUX" );
	INSERT INTO zemlje (ime_zemlje, jezik_zemlje) VALUES( "Macedonia", "MKD" );
	INSERT INTO zemlje (ime_zemlje, jezik_zemlje) VALUES( "Mexico", "MEX" );
	INSERT INTO zemlje (ime_zemlje, jezik_zemlje) VALUES( "Malta", "MLT" );
	INSERT INTO zemlje (ime_zemlje, jezik_zemlje) VALUES( "Moldova", "MDA" );
	INSERT INTO zemlje (ime_zemlje, jezik_zemlje) VALUES( "Montenegro", "MNE" );
	INSERT INTO zemlje (ime_zemlje, jezik_zemlje) VALUES( "Morocco", "MAR" );
	INSERT INTO zemlje (ime_zemlje, jezik_zemlje) VALUES( "Netherlands", "NLD" );
	INSERT INTO zemlje (ime_zemlje, jezik_zemlje) VALUES( "Norway", "NOR" );
	INSERT INTO zemlje (ime_zemlje, jezik_zemlje) VALUES( "Poland", "POL" );
	INSERT INTO zemlje (ime_zemlje, jezik_zemlje) VALUES( "Portugal", "PRT" );
	INSERT INTO zemlje (ime_zemlje, jezik_zemlje) VALUES( "Romania", "ROU" );
	INSERT INTO zemlje (ime_zemlje, jezik_zemlje) VALUES( "Russia", "RUS" );
	INSERT INTO zemlje (ime_zemlje, jezik_zemlje) VALUES( "San Marino", "SMR" );
	INSERT INTO zemlje (ime_zemlje, jezik_zemlje) VALUES( "Saudi Arabia", "SAU" );
	INSERT INTO zemlje (ime_zemlje, jezik_zemlje) VALUES( "Serbia", "SRB" );
	INSERT INTO zemlje (ime_zemlje, jezik_zemlje) VALUES( "Slovakia", "SVK" );
	INSERT INTO zemlje (ime_zemlje, jezik_zemlje) VALUES( "Slovenia", "SVN" );
	INSERT INTO zemlje (ime_zemlje, jezik_zemlje) VALUES( "Spain", "ESP" );
	INSERT INTO zemlje (ime_zemlje, jezik_zemlje) VALUES( "Sweden", "SWE" );
	INSERT INTO zemlje (ime_zemlje, jezik_zemlje) VALUES( "Switzerland", "SWZ" );
	INSERT INTO zemlje (ime_zemlje, jezik_zemlje) VALUES( "Turkey", "TUR" );
	INSERT INTO zemlje (ime_zemlje, jezik_zemlje) VALUES( "Ukraine", "UKR" );
	INSERT INTO zemlje (ime_zemlje, jezik_zemlje) VALUES( "United Kingdom", "GBR" );
	INSERT INTO zemlje (ime_zemlje, jezik_zemlje) VALUES( "United States", "USA" );

/*
	KAMP
*/
	DROP TABLE IF EXISTS kamp;
	CREATE TABLE kamp (
		intk int primary key auto_increment,
		ime_kampa varchar(50) not null,
		kod_kampa varchar(50) not null,
		zemlja char(25) not null,
		organizacija varchar(50) not null,
		lokacija_kampa varchar(100) not null,
		regija_kampa varchar(100) not null,
		jezik_kampa varchar(50) not null,
		tip_kampa varchar(30),
		
		pocetakDan int not null,
		pocetakMjesec int not null,
		pocetakGodina int not null,
		krajDan int not null,
		krajMjesec int not null,
		krajGodina int not null,
		
		ukupanBrojVolontera int not null,
		
		dodatniTroskovi varchar(50),
		minimumGodina varchar(20),
		maksimumGodina varchar(20),
		
		opis_kampa text,
		opis_posla text,
		opis_lokacije text,
		opis_potreba text,
		dodatne_info text
	)DEFAULT charset utf8;
	INSERT INTO kamp (ime_kampa, kod_kampa, zemlja, organizacija, lokacija_kampa, regija_kampa, jezik_kampa, tip_kampa, pocetakDan, pocetakMjesec, pocetakGodina, krajDan, krajMjesec, krajGodina, ukupanBrojVolontera, dodatniTroskovi, minimumGodina, maksimumGodina, opis_kampa, opis_posla, opis_lokacije, opis_potreba, dodatne_info) VALUES (
		"Traditional Lime heritage", "IT-SCI 9.2", "Italy", "SCI Italy", /* ime_kampa, kod_kampa, zemlja, organizacija*/
		"San Giovanni a Piro", "Neka lokacija", "English", "TEEN, LTV, MTV", /*lokacijja, jezik_kampa, adresa_slike, tip_kampa*/
		21, 5, 2013, /*pocetak dan, mjesec, godina */
		31, 7, 2013, /* kraj dan, mjesec, godina*/
		10, /* ukupanBrojVolontera, brojMuskaraca, brojZena */
		"", 16, 99, /*dodatniTroskovi, minumumGodina, maksimumGodina*/
		"The association A.U.S.S. Architettura e Urbanistica Sostenibili (Sustainable Architecture and Urbanism), was founded in 2004 aiming at spreading the experimentation and debate on architecture and urbanism designed according to sustainability criteria while preserving environmental and social impacts. The aim of the project is to create a regional educational workshop for the recovery of the traditional technology of lime production, particularly felt in the memories of local inhabitants and from specialists working in the field of restoration, compatible architecture and construction quality.", /*opis kampa*/
		"During a course organized by the Italian Forum Lime, which will be attended by people interested in the recovery of this construction technique, the volunteers will be: . support the dissemination of the event, . support the preparation of the event, giving space to the suggestions and ideas of the volunteers group, . support in the preparation of the site to produce lime. Then, for about five days, the volunteers will in turns of day and night keep alive the furnace, necessary to the production of lime. Finally the volunteers will help in the organisation of the public event. Study Theme: The study part will focus on the following: - presentation of the association A.u.s.s. and its previous activities in the territory. - presentation and explanation of the project and the lime production, that are important as a tool to recover the local identity and culture. - presentation of the operation of the wetlands system and energy-saving techniques used in the hosting pl", /*opis posla*/
		"Airports: Napoli, Pontecagnano e Lamezia Terme. The workcamp will take place in the mountain in the territory of the Gulf of Policastro in San Giovanni a Piro in the soil of a local person who has used its own resources for the construction of furnaces and hospital", /*opis lokacije*/
		"We invite volunteers with attitude to manual work, with initiative and proactivity capacities, able to propose creative ways of dissemination of the local event and able to entertain and animate the public event with juggling, music, theater and other artistic skills. Attitude to mountain life. The camp language is English. It is reccomended to speak some italian since a lot of local people don't speak an other language, enabaling further interaction with", /*opis potreba*/
		"More info on the partner organisation: (http://www.inventati.org/auss/) (http://www.inventati.org/auss/carcare.htm) More info on the [Lime production](http://en.wikipedia.org/wiki/Lime_kiln)" /*dodatne info*/
	);
	INSERT INTO kamp (ime_kampa, kod_kampa, zemlja, organizacija, lokacija_kampa, regija_kampa, jezik_kampa, tip_kampa, pocetakDan, pocetakMjesec, pocetakGodina, krajDan, krajMjesec, krajGodina, ukupanBrojVolontera, dodatniTroskovi, minimumGodina, maksimumGodina, opis_kampa, opis_posla, opis_lokacije, opis_potreba, dodatne_info) VALUES (
		"Like! Lake", /*ime_kampa*/
		"VOC 01", /*kod_kampa*/
		"Montenegro", /*zemlja*/
		"ADP-ZID", /* organizacija*/
		
		"Pljevlja", /*lokacija_kampa*/
		"North Montenegro", /*regija_kampa*/
		"English", /* jezika_kampa*/
		"CULT", /*tip_kampa*/
		
		25, 6, 2013, /*pocetak dan, mjesec, godina */
		5, 7, 2013, /* kraj dan, mjesec, godina*/
		
		10, /* ukupanBrojVolontera */
		"25 €",/*dodatniTroskovi*/
		18, 45, /*minumumGodina, maksimumGodina*/
		
		"The project will take place in Pljevlja, north part of Montenegro. The volunteers will be worked on cleaning and removing the waste around the Borovica Lake. Volunteers will be cleaning the area around Borovica Lake, removing the waste all along the shores of Lake. Working hours will be about 5/6 per day.", /*opis kampa*/
		
		"Airport 
Podgorica
Train station 
Bijelo Polje, Podgorica", /*opis posla*/

		"Airports: Napoli, Pontecagnano e Lamezia Terme. The workcamp will take place in the mountain in the territory of the Gulf of Policastro in San Giovanni a Piro in the soil of a local person who has used its own resources for the construction of furnaces and hospital", /*opis lokacije*/
		
		"We invite volunteers with attitude to manual work, with initiative and proactivity capacities, able to propose creative ways of dissemination of the local event and able to entertain and animate the public event with juggling, music, theater and other artistic skills. Attitude to mountain life. The camp language is English. It is reccomended to speak some italian since a lot of local people don't speak an other language, enabaling further interaction with", /*opis potreba*/
		
		"Volunteers should provide their own health and accident insurance! Workcamp will be conformed till 2013/04/15." /*dodatne info*/
	);
	INSERT INTO kamp (ime_kampa, kod_kampa, zemlja, organizacija, lokacija_kampa, regija_kampa, jezik_kampa, tip_kampa, pocetakDan, pocetakMjesec, pocetakGodina, krajDan, krajMjesec, krajGodina, ukupanBrojVolontera, dodatniTroskovi, minimumGodina, maksimumGodina, opis_kampa, opis_posla, opis_lokacije, opis_potreba, dodatne_info) VALUES (
		"Survive in nature", /*ime_kampa*/
		"VOC 2", /*kod_kampa*/
		"Montenegro", /*zemlja*/
		"ADP-ZID", /* organizacija*/
		
		"Vrela, Zabljak", /*lokacija_kampa*/
		"North Montenegro", /*regija_kampa*/
		"English", /* jezika_kampa*/
		"CULT", /*tip_kampa*/
		
		25, 6, 2013, /*pocetak dan, mjesec, godina */
		5, 7, 2013, /* kraj dan, mjesec, godina*/
		
		10, /* ukupanBrojVolontera */
		"25 €",/*dodatniTroskovi*/
		18, 45, /*minumumGodina, maksimumGodina*/
		
		"The project will take place in Vrela near to Žabljak and Pljevlja, north part of Montenegro. The volunteers will be learning about medicinal herbs and they will prepare mini herbs garden. During the camp, volunteers will learn to distinguish between herbs, of which will make a small medicinal plants nursery. They will learn that which are honey producing plants and obtain basic theoretical knowledge about beekeeping. Working hours will be about 5per day.", /*opis kampa*/
		
		"Airport 
Podgorica
Train station 
Bijelo Polje, Podgorica", /*opis posla*/

		"--", /*opis lokacije*/
		
		"--", /*opis potreba*/
		
		"Volunteers should provide their own health and accident insurance! Workcamp will be conformed till 2013/04/15." /*dodatne info*/
	);
	INSERT INTO kamp (ime_kampa, kod_kampa, zemlja, organizacija, lokacija_kampa, regija_kampa, jezik_kampa, tip_kampa, pocetakDan, pocetakMjesec, pocetakGodina, krajDan, krajMjesec, krajGodina, ukupanBrojVolontera, dodatniTroskovi, minimumGodina, maksimumGodina, opis_kampa, opis_posla, opis_lokacije, opis_potreba, dodatne_info) VALUES (
		"Creative Time", /*ime_kampa*/
		"VOC 03", /*kod_kampa*/
		"Montenegro", /*zemlja*/
		"ADP-ZID", /* organizacija*/
		
		"Zupa, Niksic", /*lokacija_kampa*/
		"Niksix", /*regija_kampa*/
		"English", /* jezika_kampa*/
		"KIDS", /*tip_kampa*/
		
		25, 6, 2013, /*pocetak dan, mjesec, godina */
		5, 7, 2013, /* kraj dan, mjesec, godina*/
		
		7, /* ukupanBrojVolontera */
		0, 0, /* brojMuskaraca, brojZena */
		"25 €",/*dodatniTroskovi*/
		
		"The project will take place in Zupa Niksicka near to Niksic, central part of Montenegro. Increase the confidence of young people with physical disabilities and make influence on reduce of prejudice and there socialization through realization of creative workshops. During the camp, volunteers will taking part in creative workshops with children with disabilities, they will do personal assistance, outdoor activities, drawing, singing and painting... ", /*opis kampa*/
		
		" 
Airport 
Podgorica
Train station 
Pdgorica, Bijelo Polje", /*opis posla*/

		"--", /*opis lokacije*/
		
		"--", /*opis potreba*/
		
		"Volunteers should provide their own health and accident insurance!" /*dodatne info*/
	);	
	
	/*
		KAMP BACKGORUND
	*/
	DROP TABLE IF EXISTS kamp_background;
	CREATE TABLE kamp_background(
		idkb int primary key auto_increment,
		adresa text
	);
	INSERT INTO	kamp_background (adresa) VALUES ('http://barcelona-home.com/cms/wp-content/uploads/2012/09/hoteles-en-barcelona-confortel.jpg');
	INSERT INTO	kamp_background (adresa) VALUES ('https://fbcdn-sphotos-b-a.akamaihd.net/hphotos-ak-frc1/481495_376916502403374_2113145038_n.jpg');
	INSERT INTO	kamp_background (adresa) VALUES ('http://upload.wikimedia.org/wikipedia/commons/e/ee/Mojkovac_Center.JPG');
	INSERT INTO	kamp_background (adresa) VALUES ('http://www.booking.me/userFiles/upload/images/Mojkovac,%20Crna%20Gora.jpg');
	INSERT INTO	kamp_background (adresa) VALUES ('http://www.newyorkportables.com/images/sitebuilderpictures/nyc001.jpg');
	INSERT INTO	kamp_background (adresa) VALUES ('https://fbcdn-sphotos-e-a.akamaihd.net/hphotos-ak-ash3/q79/s720x720/1044656_10200672093217207_1217317065_n.jpg');
	INSERT INTO	kamp_background (adresa) VALUES ('http://static.panoramio.com/photos/large/28294475.jpg');
	INSERT INTO	kamp_background (adresa) VALUES ('http://static.panoramio.com/photos/large/28294504.jpg');
	INSERT INTO	kamp_background (adresa) VALUES ('http://nixietale.files.wordpress.com/2012/09/chicago-skyline.jpg');
	INSERT INTO	kamp_background (adresa) VALUES ('http://zoomarun.com/wp-content/uploads/2013/01/ChicagoSkyline.jpg');
	INSERT INTO	kamp_background (adresa) VALUES ('http://hdwallpaperfreedownload.com/wp-content/gallery/rio-de-janaro/rio-de-janeiro-wallpaper-hd-113.jpg');
	INSERT INTO	kamp_background (adresa) VALUES ('http://www.wallpaper4me.com/images/wallpapers/blue_beach_bluff_w1.jpeg');
	INSERT INTO	kamp_background (adresa) VALUES ('http://images1.fanpop.com/images/photos/2600000/HQ-France-wallpapers-france-2627157-1600-1200.jpg');
	INSERT INTO	kamp_background (adresa) VALUES ('http://hdnaturepictures.com/wp-content/uploads/2013/05/Nice-Light-City-Night.jpg');
	INSERT INTO	kamp_background (adresa) VALUES ('http://www.hdwallpapersdesign.com/wp-content/uploads/2013/05/star-wars-wallpaper-23.jpg');
	INSERT INTO	kamp_background (adresa) VALUES ('http://www.listofimages.com/wp-content/uploads/2013/03/digital-city-abstract-abstract-hd-wallpaper-digital-city.jpg');
	INSERT INTO	kamp_background (adresa) VALUES ('http://wallpapers.windowsace.com/pics/w/a/wallpaper-old-definition-car-desktopia-high-city-wallpapers--e-i-ibackgroundz.com.jpg');
	INSERT INTO	kamp_background (adresa) VALUES ('http://www.mrwallpaper.com/wallpapers/Downhill-Mountain-Biking-1920x1200.jpg');
	INSERT INTO	kamp_background (adresa) VALUES ('http://www.wallpapershd.us/wp-content/uploads/2012/10/looking_at_paris_wallpaper_jxhy.jpg');
	INSERT INTO	kamp_background (adresa) VALUES ('http://images5.fanpop.com/image/photos/30700000/Bonjour-Paris-paris-30708270-1920-1080.jpg');
	INSERT INTO	kamp_background (adresa) VALUES ('http://2.bp.blogspot.com/-ooexJizLH3k/UQfxDW6GNqI/AAAAAAAAI1c/4JtvRLu5QnI/s1600/img_130119_e5e52f05a62b07b608eda253e7c0db65.jpeg');
	INSERT INTO	kamp_background (adresa) VALUES ('http://www.bhmpics.com/walls/leonid_afremov-other.jpg');
	INSERT INTO	kamp_background (adresa) VALUES ('http://jdavidgentle.com/wp-content/uploads/2013/02/night_harbor.jpg');
	INSERT INTO	kamp_background (adresa) VALUES ('http://wallpaper-fullhd.com/wp-content/uploads/2013/03/at-the-beach-hd-wallpaper-1920x1200.jpg');
	INSERT INTO	kamp_background (adresa) VALUES ('http://www.hdwallpapers3d.com/wp-content/uploads/2013/04/beach-wallpaper-hd-11.jpg');
	INSERT INTO	kamp_background (adresa) VALUES ('http://www.hdwallpapersplus.com/wp-content/uploads/2013/04/hd-wallpapers-5.jpg');
	
	/*
		KAMP_LISTA
	*/
	DROP TABLE IF EXISTS kamp_lista;
	CREATE TABLE kamp_lista(
		idkl int primary key auto_increment,
		id_kampa int,
		clan_lista varchar(25),
		ime_kampa varchar(50),
		kod_kampa varchar(50),
		zemlja_kampa varchar(25),
		pocetakDan int not null,
		pocetakMjesec int not null,
		pocetakGodina int not null,
		krajDan int not null,
		krajMjesec int not null,
		krajGodina int not null
	);
	
	/*
		TIPOVI KAMPOVA
	*/
	DROP TABLE IF EXISTS tip_kampa;
	CREATE TABLE tip_kampa(
		idtp int primary key auto_increment,
		oznaka varchar(5) not null
	);
	INSERT INTO tip_kampa(oznaka) VALUES ("AGRI"); /* agrikultura */
	INSERT INTO tip_kampa(oznaka) VALUES ("ARCH"); /* arhitektura */
	INSERT INTO tip_kampa(oznaka) VALUES ("ART"); /* umjetnost */
	INSERT INTO tip_kampa(oznaka) VALUES ("CONS"); /* construction */
	INSERT INTO tip_kampa(oznaka) VALUES ("CULT"); /* Cultural Projects */
	INSERT INTO tip_kampa(oznaka) VALUES ("DISA"); /* Work with people with disabilities */
	INSERT INTO tip_kampa(oznaka) VALUES ("EDU"); /* Educational */
	INSERT INTO tip_kampa(oznaka) VALUES ("ELDE"); /* Work with elderly */
	INSERT INTO tip_kampa(oznaka) VALUES ("ENVI"); /* Environmental */
	INSERT INTO tip_kampa(oznaka) VALUES ("FAM"); /* Family */
	INSERT INTO tip_kampa(oznaka) VALUES ("FEST"); /* Festival */
	INSERT INTO tip_kampa(oznaka) VALUES ("KIDS"); /* Work with children */
	INSERT INTO tip_kampa(oznaka) VALUES ("LANG"); /* Language */
	INSERT INTO tip_kampa(oznaka) VALUES ("LEAD"); /* Camp leader */
	INSERT INTO tip_kampa(oznaka) VALUES ("MANU"); /* Manual work */
	INSERT INTO tip_kampa(oznaka) VALUES ("RENO"); /* Renovation */
	INSERT INTO tip_kampa(oznaka) VALUES ("SOCI"); /* Social projects (refugees, minorities, health...) */
	INSERT INTO tip_kampa(oznaka) VALUES ("SPOR"); /* Sport */
	INSERT INTO tip_kampa(oznaka) VALUES ("STUD"); /* Study theme projects (history, reasearch) */
	INSERT INTO tip_kampa(oznaka) VALUES ("TEEN"); /* Teenagers */
	INSERT INTO tip_kampa(oznaka) VALUES ("TRAS"); /* Translation projects */
	INSERT INTO tip_kampa(oznaka) VALUES ("YOGA"); /* Yoga projects */
	INSERT INTO tip_kampa(oznaka) VALUES ("ZOO"); /* Work with animals */
	INSERT INTO tip_kampa(oznaka) VALUES ("LTV"); /* Long term voluntering */
	INSERT INTO tip_kampa(oznaka) VALUES ("MTV"); /* Medium term voluntering */