package hu.tanuloapp.afp2.models;

public class Question {

    private int id;
    private String cim;
    private String kerdes1;
    private String kerdes2;
    private String kerdes3;
    private String kerdes4;
    private String joValasz;

    public Question(int id, String cim, String kerdes1, String kerdes2, String kerdes3, String kerdes4, String joValasz) {
        this.id = id;
        this.cim = cim;
        this.kerdes1 = kerdes1;
        this.kerdes2 = kerdes2;
        this.kerdes3 = kerdes3;
        this.kerdes4 = kerdes4;
        this.joValasz = joValasz;
    }

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public String getCim() {
        return cim;
    }

    public void setCim(String cim) {
        this.cim = cim;
    }

    public String getKerdes1() {
        return kerdes1;
    }

    public void setKerdes1(String kerdes1) {
        this.kerdes1 = kerdes1;
    }

    public String getKerdes2() {
        return kerdes2;
    }

    public void setKerdes2(String kerdes2) {
        this.kerdes2 = kerdes2;
    }

    public String getKerdes3() {
        return kerdes3;
    }

    public void setKerdes3(String kerdes3) {
        this.kerdes3 = kerdes3;
    }

    public String getKerdes4() {
        return kerdes4;
    }

    public void setKerdes4(String kerdes4) {
        this.kerdes4 = kerdes4;
    }

    public String getJoValasz() {
        return joValasz;
    }

    public void setJoValasz(String joValasz) {
        this.joValasz = joValasz;
    }
}
