package hu.tanuloapp.afp2.authentication.fragments;


import android.content.Intent;
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
import java.util.Objects;

import hu.tanuloapp.afp2.MainActivity;
import hu.tanuloapp.afp2.R;
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
public class LoginFragment extends Fragment {


    public LoginFragment() {
        // Required empty public constructor
    }

    public static void login(final String username, final String password, StatusCallback statusCallback) {
        OkHttpClient okHttpClient = new OkHttpClient();

        HttpUrl httpUrl = new HttpUrl.Builder()
                .scheme("") // TODO: 2019.04.01. fix protocol
                .host("") // TODO: 2019.04.01. fix host
                .port(0) // TODO: 2019.04.01. fix port
                .addPathSegment("") // TODO: 2019.04.01. add path segment
                .build();

        JSONObject object = new JSONObject();
        try {
            object.put("username", username);
            object.put("password", password);
        } catch (JSONException e) {
            e.printStackTrace();
        }

        MediaType JSON = MediaType.parse("application/json; charset=utf-8");

        RequestBody body = RequestBody.create(JSON, object.toString());
        Request request = new Request.Builder()
                .url(httpUrl)
                .post(body)
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
    public View onCreateView(@NonNull LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        View view = inflater.inflate(R.layout.fragment_login, container, false);

        EditText username = view.findViewById(R.id.Name);
        EditText password = view.findViewById(R.id.Password);

        Button login = view.findViewById(R.id.Login);
        login.setOnClickListener(v -> {
            String user = username.getText().toString();
            String pass = password.getText().toString();
            // TODO: 2019.03.24. login business logic

            if (user.isEmpty()) {
                username.setError("Felhasználónév mező nem lehet üres!");
            } else if (pass.isEmpty()) {
                password.setError("Jelszó mező nem lehet üres!");
            } else {
                login(user, pass, new StatusCallback() {
                    @Override
                    public void onSuccess(String response) {
                        Toast.makeText(getContext(), response, Toast.LENGTH_LONG).show();
                        startActivity(new Intent(getContext(), MainActivity.class));
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
