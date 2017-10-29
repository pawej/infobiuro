<?
session_start();
include("includes/funkcje.php");
//w zale¿noœci od zmiennej "m" ³aduj¹ ró¿ne funkcje z pliku funkcje.php

//strony logowania
if ($m=="")
{
	head ("Logowanie");
	formularz_logowania_html("Logowanie");
}

if($m=="zaloguj")
{
	if (logowanie($user, $haslo))
	{	
	$imie_login=$user;
	session_register("imie_login");
	head ("Baza klientów");
	pokaz_menu();
	podsumowanie ();
	foot ();
	}
	else
	{
	head ("Logowanie");
	formularz_logowania_html("<font color=red><strong>B³¹d</strong></font>");
	}
}

//strona startowa

if ($m=="start")
{
	if (!session_is_registered('imie_login')) 
	{
	echo "<a href=index.php>Zaloguj siê</a>";
	}
	else 
	{
	head ("Logowanie");
	pokaz_menu();
	podsumowanie ();
	foot ();
	}
}

//strona wylogowania

if($m=="wyloguj")
{
	session_destroy();
	head ("Wylogowany");
	formularz_logowania_html("<font color=red>Zosta³eœ wylogowany</font>");
}

//lista klientów
if($m=="klienci")
{
if (!session_is_registered('imie_login')) 
	{
	echo "<a href=index.php>Zaloguj siê</a>";
	}
	else 
	{
	head ("Lista klientów");
	pokaz_menu();
	lista_klientow($kolumna,$akcja,$id_klienci,$send,$nr, $ozn, $nazwisko, $id_abonamenty);
	foot ();
	}
}

//strona dodawanie klienta

if($m=="dodaj_klienta")
{
if (!session_is_registered('imie_login')) 
	{
	echo "<a href=index.php>Zaloguj siê</a>";
	}
	else 
	{
	head ("Dodaj klienta");
	pokaz_menu();
	dodaj_klienta($nazwisko,$ozn,$nr,$send,$abonament);
	foot ();
}
}

//wystawianie faktur

if($m=="wyst_faktur")
{
if (!session_is_registered('imie_login')) 
	{
	echo "<a href=index.php>Zaloguj siê</a>";
	}
	else 
	{
	head ("Wystawianie faktur");
	pokaz_menu();
	wystaw_faktury($mc,$rok,$kolumna,$send1,$abonament,$nazwisko,$kwota);
	foot ();
	}
}


//strona zap³aty

if($m=="zaplaty")
{
if (!session_is_registered('imie_login')) 
	{
	echo "<a href=index.php>Zaloguj siê</a>";
	}
	else 
	{
	head ("P³atnoœci");
	pokaz_menu();
	zaplata($kolumna,$send,$send1,$id_faktury,$abonament,$kwota,$zaplata_cz,$id_klienci,$kwota_b_fak,$mc,$rok,$id_bez_faktury,$data_zaplaty);
	foot ();
	}
}

//kartoteka userów

if($m=="user")
{
if (!session_is_registered('imie_login')) 
	{
	echo "<a href=index.php>Zaloguj siê</a>";
	}
	else 
	{
	head ("U¿ytkownicy systemu");
	pokaz_menu();
	userzy($akcja,$id_uzytkownicy,$login,$haslo);
	foot ();
	}
}

//kartoteka abonamentów

if($m=="abo")
{
if (!session_is_registered('imie_login')) 
	{
	echo "<a href=index.php>Zaloguj siê</a>";
	}
	else 
	{
	head ("Abonamenty");
	pokaz_menu();
	abonamenty ($akcja,$nazwa,$predkosc,$oplata,$id_abonamenty);
	foot ();
	}
}
?>

