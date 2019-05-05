package hu.tanuloapp.afp2.authentication.fragments;


import android.os.Bundle;
import android.os.Handler;
import android.os.Looper;
import android.support.annotation.NonNull;
import android.support.v4.app.Fragment;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import org.json.JSONException;
import org.json.JSONObject;

import java.io.IOException;
import java.security.NoSuchAlgorithmException;
import java.util.Objects;
import java.security.MessageDigest;

import hu.tanuloapp.afp2.R;
import hu.tanuloapp.afp2.authentication.AuthenticationActivity;
import okhttp3.Call;
import okhttp3.Callback;
import okhttp3.HttpUrl;
import okhttp3.MediaType;
import okhttp3.OkHttpClient;
import okhttp3.Request;
import okhttp3.RequestBody;
import okhttp3.Response;

/**
 * A simple {@link Fragment} subclass.
 */
public class RegistrationFragment extends Fragment {


    public RegistrationFragment() {
        // Required empty public constructor
    }

    public static String getHash(String s){
        try {
            MessageDigest digest = java.security.MessageDigest.getInstance("SHA-256");
            digest.update(s.getBytes());
            byte messageDigest[] = digest.digest();

            StringBuffer hexString = new StringBuffer();
            for (int i=0; i<messageDigest.length; i++)
                hexString.append(Integer.toHexString(0xFF & messageDigest[i]));
            return hexString.toString();

        } catch (NoSuchAlgorithmException e) {
            e.printStackTrace();
        }
        return "";
    }

    public static void register(final String username, final String password, String email, StatusCallback statusCallback) {
        OkHttpClient okHttpClient = new OkHttpClient();

        HttpUrl httpUrl = new HttpUrl.Builder()
                .scheme("http")
                .host("www.afp2019a.nhely.hu")
                .port(80)
                .addPathSegment("public")
                .addPathSegment("register")
                .build();

        String hashedPass = getHash(password);

        JSONObject object = new JSONObject();
        try {
            object.put("user", username);
            object.put("password", hashedPass);
            object.put("email", email);
        } catch (JSONException e) {
            e.printStackTrace();
        }

        MediaType JSON = MediaType.parse("application/json; charset=utf-8");

        RequestBody body = RequestBody.create(JSON, object.toString());
        Request request = new Request.Builder()
                .url(httpUrl)
                .put(body)
                .build();

        Log.d("afp", "login: sending login request -> " + request.toString());

        okHttpClient.newCall(request).enqueue(new Callback() {
            @Override
            public void onFailure(@NonNull final Call call, @NonNull final IOException e) {
                Log.e("afp", "onFailure: " + e.getLocalizedMessage(), e);
                new Handler(Looper.getMainLooper()).post(() -> statusCallback.onFailure(e.getLocalizedMessage()));
            }

            @Override
            public void onResponse(@NonNull Call call, @NonNull final Response response) throws IOException {
                final String result = Objects.requireNonNull(response.body()).string();
                Log.d("afp", "onResponse: " + result);
                if (response.isSuccessful()) {
                    new Handler(Looper.getMainLooper()).post(() -> {
                        try {
                            if (new JSONObject(result).getInt("status") == 0) {
                                statusCallback.onFailure(new JSONObject(result).getString("status_message"));
                            } else if (new JSONObject(result).getInt("status") == 1) {
                                statusCallback.onSuccess(new JSONObject(result).getString("status_message"));
                            }
                        } catch (JSONException e) {
                            Log.e("afp", "onResponse: " + e.getLocalizedMessage(), e);
                            statusCallback.onFailure(e.getLocalizedMessage());
                        }
                    });
                } else {
                    new Handler(Looper.getMainLooper()).post(() -> statusCallback.onFailure("Something went wrong"));
                }
            }
        });
    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        View view = inflater.inflate(R.layout.fragment_registration, container, false);

        EditText username = view.findViewById(R.id.Name);
        EditText password = view.findViewById(R.id.Password);
        EditText password2 = view.findViewById(R.id.Password2);
        EditText emailadd = view.findViewById(R.id.Email);

        Button registration = view.findViewById(R.id.Registration);
        registration.setOnClickListener(v -> {
            String user = username.getText().toString();
            String pass = password.getText().toString();
            String pass2 = password2.getText().toString();
            String email = emailadd.getText().toString();

            // TODO: 2019.03.24. login business logic

            if (user.isEmpty()) {
                username.setError("A felhasználó név nem lehet üres!");
            } else if (pass.isEmpty()) {
                password.setError("A jelszó mező nem lehet üres!");
            } else if (pass2.isEmpty()) {
                password2.setError("A jelszót meg kell erősíteni!");
            } else if (!pass.equals(pass2)) {
                password.setError("A jelszavak nem egyeznek!");
                password2.setError("A jelszavak nem egyeznek!");
            }
            else if (email.isEmpty()){
                emailadd.setError("Az email mező nem lehet üres!");
            }
            else {
                register(user, pass, email, new StatusCallback() {
                    @Override
                    public void onSuccess(String response) {
                        Toast.makeText(getContext(), response, Toast.LENGTH_LONG).show();
                        ((AuthenticationActivity) Objects.requireNonNull(getActivity())).getViewPager().setCurrentItem(0);
                    }

                    @Override
                    public void onFailure(String message) {
                        Toast.makeText(getContext(), message, Toast.LENGTH_LONG).show();
                    }
                });
            }

        });

        return view;
    }

    public interface StatusCallback {
        void onSuccess(String response);

        void onFailure(String message);
    }

}
