package hu.tanuloapp.afp2.authentication.fragments;


import android.os.Bundle;
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
public class RegistrationFragment extends Fragment {


    public RegistrationFragment() {
        // Required empty public constructor
    }


    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        // Inflate the layout for this fragment
        View view = inflater.inflate(R.layout.fragment_registration, container, false);

        EditText username = view.findViewById(R.id.Name);
        EditText password = view.findViewById(R.id.Password);
        EditText password2 = view.findViewById(R.id.Password2);

        Button login = view.findViewById(R.id.Login);
        login.setOnClickListener(v -> {
            String user = username.getText().toString();
            String pass = password.getText().toString();
            String pass2 = password2.getText().toString();
            // TODO: 2019.03.24. login business logic
            
        });

        return view;
    }

}
