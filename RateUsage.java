import java.sql.*;
import java.util.HashMap;
import java.util.Arrays;

public class RateUsage {
    static final String DB_URL = "jdbc:mysql://localhost:3306/new_nus?serverTimezone=Asia/Jakarta";
    static final String USER = "nus";
    static final String PASS = "Rn1u2sE";

    // Dev
    // static final String DB_URL = "jdbc:mysql://localhost/new_nus2?serverTimezone=Asia/Jakarta";
    // static final String USER = "root";
    // static final String PASS = "";

    public static void main(String[] args) {
        Connection conn = null;
        Statement stmt = null;
        PreparedStatement pstmt = null;
        ResultSet rs = null;
        try{
            Class.forName("com.mysql.jdbc.Driver");
            conn = DriverManager.getConnection(DB_URL,USER,PASS);

            stmt = conn.createStatement();
            String sql;
            sql = "SELECT * FROM RATING_PARAM";
            rs = stmt.executeQuery(sql);

            HashMap<Integer, Integer> rate_param = new HashMap<>();
            while(rs.next()){
                int service_type = rs.getInt(1);
                int amount = rs.getInt(3);

                rate_param.put(service_type, amount);
            }

            //TODO get price w/ currency
            sql = "SELECT CURRENCY, AMOUNT FROM PRICE_PER_KB";
            rs = stmt.executeQuery(sql);

            HashMap<String, Double> rate_table = new HashMap<>();
            while(rs.next()){
                String currency = rs.getString(1);
                double rate = rs.getDouble(2);

                rate_table.put(currency,rate);
            }
            // rate_table.put("USD",0.000265);
            // rate_table.put("RP",3.975);

            sql = "SELECT COMPANY, CURRENCY FROM BILLING order by DUE_DATE asc";
            rs = stmt.executeQuery(sql);

            HashMap<Integer, Double> company_rate_map = new HashMap<>();
            while(rs.next()){
                int company_id = rs.getInt(1);
                String currency = rs.getString(2);

                if(currency != null && rate_table.containsKey(currency)){
                    company_rate_map.put(company_id, rate_table.get(currency));
                } else if (rate_table.containsKey("USD")) {
                    company_rate_map.put(company_id, rate_table.get("USD"));
                } else {
                    company_rate_map.put(company_id, 1.0);
                }
            }

            sql = "SELECT ud.*, um.COMPANY_ID FROM USAGE_DETAIL ud left join USAGE_SUMMARY um on ud.USAGE_SUMMARY = um.id"
                +" WHERE (ud.RATE_STATUS is null OR ud.RATE_STATUS = 0)"
                ;
            rs = stmt.executeQuery(sql);

            // HashMap<String, int[]> usage_amount = new HashMap<>();

            while(rs.next()){
                // String sql_flag = "UPDATE USAGE_DETAIL SET RATE_STATUS = 1 WHERE ID = ?";
                // pstmt = conn.prepareStatement(sql_flag);
                // pstmt.setObject(1, rs.getObject(1));
                // pstmt.executeUpdate();

                double rate_price = company_rate_map.get(rs.getInt("COMPANY_ID"));

                String usage_summary = rs.getString("USAGE_SUMMARY");
                int service_type = rs.getInt("SERVICE_TYPE");

                // if(!usage_amount.containsKey(usage_summary)){
                //     usage_amount.put(usage_summary,new int[6]);
                // }
                double usage_amount_rate = 0;

                switch(service_type){
                    case 1:
                        // usage_amount.get(usage_summary)[0] += 1;
                        usage_amount_rate = rate_param.get(service_type) * rate_price;
                        break;
                    case 2:
                        // usage_amount.get(usage_summary)[1] += 1;
                        usage_amount_rate = rate_param.get(service_type) * rate_price;
                        break;
                    case 3:
                        // usage_amount.get(usage_summary)[2] += 1;
                        usage_amount_rate = rate_param.get(service_type) * rate_price;
                        break;
                    case 4:
                        // usage_amount.get(usage_summary)[3] += rs.getInt(9);
                        usage_amount_rate = rate_param.get(service_type) * rs.getInt("DURATION") * rate_price;
                        break;
                    case 5:
                        // usage_amount.get(usage_summary)[4] += rs.getInt(9);
                        usage_amount_rate = rate_param.get(service_type) * rs.getInt("DURATION") * rate_price;
                        break;
                    case 6:
                        // usage_amount.get(usage_summary)[5] += rs.getInt(9);
                        usage_amount_rate = rate_param.get(service_type) * rs.getInt("DURATION") * rate_price;
                        break;
                    default:
                        break;
                }
                // System.out.println(rs.getInt(1) + " - " + usage_summary + " - " + usage_amount_rate);

                // String sql_rate = "INSERT IGNORE INTO RATING (ID, USAGE_SUMMARY, SERVICE_TYPE, `FROM`, `TO`, "
                //         + "CONTENT_ID, CONTENT, USAGE_DATE, DURATION, CREATED_AT, RATE_AMOUNT) VALUES ("
                //         + "?,?,?,?,?,?,?,?,?,?,?"
                //         + ") ";

                // pstmt = conn.prepareStatement(sql_rate);
                // pstmt.setObject(1, rs.getObject(1));
                // pstmt.setObject(2, rs.getObject(2));
                // pstmt.setObject(3, rs.getObject(3));
                // pstmt.setObject(4, rs.getObject(4));
                // pstmt.setObject(5, rs.getObject(5));
                // pstmt.setObject(6, rs.getObject(6));
                // pstmt.setObject(7, rs.getObject(7));
                // pstmt.setObject(8, rs.getObject(8));
                // pstmt.setObject(9, rs.getObject(9));
                // pstmt.setObject(10, rs.getObject(10));
                // pstmt.setDouble(11, Math.ceil(usage_amount_rate * 1000000.0)/1000000.0);
                // pstmt.executeUpdate();

                String sql_rate = "UPDATE USAGE_DETAIL SET RATE_STATUS = 1, RATE_AMOUNT = ? WHERE ID = ?";
                pstmt = conn.prepareStatement(sql_rate);
                pstmt.setObject(1, Math.ceil(usage_amount_rate * 1000000.0)/1000000.0);
                pstmt.setObject(2, rs.getObject("ID"));
                pstmt.executeUpdate();

            }
            // for (String usg : usage_amount.keySet()) {
            //     String pt = "";
            //     pt += usg + " - ";
            //     pt += Arrays.toString(usage_amount.get(usg));

            //     System.out.println(pt);
            // }
            rs.close();
            stmt.close();
            pstmt.close();
            conn.close();
        }catch(SQLException se){
            se.printStackTrace();
        }catch(Exception e){
            e.printStackTrace();
        }finally{
            try{
                if(rs!=null)
                    rs.close();
            }catch(SQLException se2){
            }// nothing we can do
            try{
                if(stmt!=null)
                    stmt.close();
            }catch(SQLException se2){
            }// nothing we can do
            try{
                if(pstmt!=null)
                    pstmt.close();
            }catch(SQLException se2){
            }// nothing we can do
            try{
                if(conn!=null)
                    conn.close();
            }catch(SQLException se){
                se.printStackTrace();
            }//end finally try
        }//end try
    }//end main
}