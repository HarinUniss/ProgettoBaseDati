import java.sql.*;
import java.time.LocalTime;
import java.time.format.DateTimeFormatter;
import java.util.Date;

import java.util.Scanner;
import java.util.*;
import java.text.DateFormat;
import java.text.ParseException;

public class Usai_Carta_Arzu_stand_alone {
    private static void closeConnection(Connection c, Statement s, ResultSet r) throws SQLException{
        if(c!=null)
            c.close();
        if(s!=null)
            s.close();
        if(r!=null)
            r.close();
        System.out.println("Thank's for using this software :)");
        System.exit(0);
    }
    private static String query_scelta(int scelta){
        Scanner sc =  new Scanner(System.in);
        switch (scelta){
            case 0:{
                System.out.println("Thank's for using this software :)");
                System.exit(0);
            }
            case 1:{
                return "select * FROM Utenti order by dataora desc limit 5;";
            }
            case 2:{
                System.out.print("Inserisci l'id dell' azienda: ");;
                return "select count(*)AS AnimaliInseriti from Animali where proprietario = "+sc.next();
            }
            case 3:{
                return "SELECT distinct citta FROM Utenti UNION\n" +
                        "SELECT distinct provenienza FROM Animali";
            }
            case 4:{
                System.out.print("Inserisci il tuo id azienda: ");
                return "select * FROM orario_apertura WHERE id_azienda = "+sc.next();
            }
            case 5:{
                System.out.print("Inserisci id utente: ");
                int id_utente = sc.nextInt();
                return "select Animali.* FROM Animali, Preferiti WHERE Preferiti.utente = "+id_utente+" AND Preferiti.animale = Animali.id_animale";
            }
            case 6:{
                System.out.println("Inserisci data Inizio");
                Date dIN = new Date(sc.nextInt());
                System.out.println("Inserisci data Fine");
                Date dEND = new Date(sc.nextInt());
               return "SELECT * FROM tabella_prenotazioni WHERE data BETWEEN '"+dIN+"' AND '"+dEND+"'";
            }
            case 7:{
                return "select count(a.id_animale) AS NumeroAnimaliTotali from animali as a;";
            }
            case 8:{
                return "select r.specie,a.razza,a.id_animale,a.nome  from razze as r,animali as a where a.razza=r.razza order by r.specie";
            }
            case 9:{
                return "SELECT a.id_animale,a.nome,a.razza, COUNT(p.utente) AS n_preferenze " +
                        "FROM (preferiti as p INNER JOIN animali as a ON p.animale = a.id_animale) " +
                        "GROUP BY a.nome order by n_preferenze desc limit 10;";
            }
            default:{
                System.out.println("Riprovare a reinserire il numero");
                return "";
            }
        }
    }
    public static void main(String[] args) {
        int scelta = -1;
        Statement stato = null;
        String query = "";
        ResultSet ris_query = null;
        ResultSetMetaData metadata = null;
        Connection connDB = null;
        System.out.println("Benvenuti nell' app stand alone di Usai, Carta, Arzu");
        Scanner sc =  new Scanner(System.in);
        try{
            //Class.forName("com.mysql.jdbc.Driver");
            connDB = DriverManager.getConnection("jdbc:mysql://localhost:3306/db_progetto", "root", "");
            //DriverManager.getConnection("jdbc:Local instance mysql://localhost/db_progetto?user=root&password=");
            while(scelta != 0){
                try{

                    System.out.println("1. Visualizzare Lista degli ultimi 5 animali inseriti");
                    System.out.println("2. Visualizzare il numero di animali per un utente");
                    System.out.println("3. Visualizzare la citta presenti nel database");
                    System.out.println("4. Visualizzare gli orari di apertura di un azienda");
                    System.out.println("5. Visualizza i preferiti di un utente");
                    System.out.println("6. Visualizza una prenotazione");
                    System.out.println("7. Visualizza il numero di animali nel database");
                    System.out.println("8. Visualizza lista di animali ordinata secondo la specie");
                    System.out.println("9. primi 10 animali con numero di persone che li hanno messi nei preferiti (TOP 10 preferiti)");
                    System.out.println("0. EXIT");

                    query = query_scelta(sc.nextInt()); //Prendo il risultato da tastiera
                    if(query.compareTo("") == 0){

                        /*closeConnection(connDB, stato, ris_query);*/
                    }else{
                        stato = connDB.createStatement();
                        ris_query = stato.executeQuery(query);
                        metadata = ris_query.getMetaData();
                        int count = metadata.getColumnCount();
                        while (ris_query.next()) {
                            for(int i = 0; i < 100; i++){
                                System.out.print("---");
                            }
                            System.out.println();
                            for(int i = 1; i <= count; i++) {
                                if(metadata.getColumnName(i).compareTo("foto") != 0){
                                    //Lettura nomi tabelle
                                    System.out.print(metadata.getColumnName(i)+": ");
                                    //Lettura contenuto
                                    System.out.print(ris_query.getString(i)+"; ");
                                }
                            }
                            System.out.println();
                        }
                        System.out.print("\nContinuare?: 0:NO, 1:SI: ");
                        int continua = sc.nextInt();
                        if(continua != 1){
                            closeConnection(connDB, stato, ris_query);
                        };
                    }


                }catch (Exception e){
                    e.printStackTrace();
                }
            }
        }catch(Exception e){
            e.printStackTrace();
            System.out.println("Errore durante l'accesso al database: " );
        }

    }
}
