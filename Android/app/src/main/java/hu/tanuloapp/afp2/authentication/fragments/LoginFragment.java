package hu.tanuloapp.afp2.authentication.fragments;


import android.os.Bundle;
import android.support.annotation.NonNull;
import android.support.v4.app.Fragment;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.EditText;

import hu.tanuloapp.afp2.R;

/**
 * A simple {@link Fragment} subclass.
 */
public class LoginFragment extends Fragment {


    public LoginFragment() {
        // Required empty public constructor
    }


    @Override
    public View onCreateView(@NonNull LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        // Inflate the layout for this fragment
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
            }

        });

        return view;
    }

}
