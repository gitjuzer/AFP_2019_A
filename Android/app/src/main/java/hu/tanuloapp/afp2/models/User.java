package hu.tanuloapp.afp2.models;

public class User {

    private static User instance;

    private static String token;
    private static String userName;
    private static String email;
    private static String role;

    private User(){}

    public static User getInstance(){
        if(instance == null){
            instance = new User();
        }
        return instance;
    }

    public static String getToken() {
        return token;
    }

    public static String getUserName() {
        return userName;
    }

    public static String getEmail() {
        return email;
    }

    public static String getRole() {
        return role;
    }

    public static void setToken(String token) {
        User.token = token;
    }

    public static void setUserName(String userName) {
        User.userName = userName;
    }

    public static void setEmail(String email) {
        User.email = email;
    }

    public static void setRole(String role) {
        User.role = role;
    }
}
