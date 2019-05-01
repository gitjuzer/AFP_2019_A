package hu.tanuloapp.afp2.models;

public class User {

    private static User instance;

    private String token;
    private String userName;
    private String email;
    private String role;

    private User(){}

    public static User getInstance(){
        if(instance == null){
            instance = new User();
        }
        return instance;
    }

    public String getToken() {
        return token;
    }

    public String getUserName() {
        return userName;
    }

    public String getEmail() {
        return email;
    }

    public String getRole() {
        return role;
    }

    public void setToken(String token) {
        this.token = token;
    }

    public void setUserName(String userName) { this.userName = userName; }

    public void setEmail(String email) {
        this.email = email;
    }

    public void setRole(String role) {
        this.role = role;
    }
}
