package hu.tanuloapp.afp2.profil;

import android.content.Intent;
import android.os.Bundle;
import android.support.v4.app.Fragment;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;

import hu.tanuloapp.afp2.R;
import hu.tanuloapp.afp2.authentication.AuthenticationActivity;
import hu.tanuloapp.afp2.authentication.fragments.LoginFragment;

public class ProfileFragment extends Fragment {


    public ProfileFragment() {

    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        View view = inflater.inflate(R.layout.fragment_profil, container, false);
        Button logout=view.findViewById(R.id.logout);
        logout.setOnClickListener(v -> {
           // getFragmentManager().beginTransaction().replace(R.id.mainFrame,new );
           startActivity(new Intent(getContext(), AuthenticationActivity.class));

        });
        Button passwordchange=view.findViewById(R.id.passwordchange);
        passwordchange.setOnClickListener(v -> {
            getFragmentManager().beginTransaction().replace(R.id.mainFrame,new PasswordChange() ).commit();
            //startActivity(new Intent(getContext(), AuthenticationActivity.class));

        });

        return view;

    }
}