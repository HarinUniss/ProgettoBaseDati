import java.sql.DriverManager;
import java.sql.Statement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Connection;
import java.sql.ResultSetMetaData;

import java.util.Scanner;

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

        switch (scelta){
            case 0:{
                System.out.println("Thank's for using this software :)");
                System.exit(0);
            }
            case 1:{
                return "select * FROM Utenti order by dataora desc limit 5;";
            }
            case 2:{
                return "select count(*), Utenti.nome from Animali, Utenti where Utenti.nome = \"Allevamento giovanni\";";
            }
            case 3:{
                return "";
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
                    System.out.println("2. Visualizzare L'utente con più animali");
                    System.out.println("3. Visualizzare la citta di provenienza piu comune");
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
                            System.out.print("\n");
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
