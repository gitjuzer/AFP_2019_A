package hu.tanuloapp.afp2.profil;

import android.content.Intent;
import android.os.Bundle;
import android.support.v4.app.Fragment;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.TextView;

import hu.tanuloapp.afp2.R;
import hu.tanuloapp.afp2.authentication.AuthenticationActivity;
import hu.tanuloapp.afp2.authentication.fragments.LoginFragment;
import hu.tanuloapp.afp2.models.User;

public class ProfileFragment extends Fragment {


    public ProfileFragment() {

    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        View view = inflater.inflate(R.layout.fragment_profil, container, false);
        User loggedUser= User.getInstance();
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
        TextView name=view.findViewById(R.id.name);
        TextView email=view.findViewById(R.id.mail);
        name.setText(loggedUser.getUserName());
        email.setText(loggedUser.getEmail());
        return view;

    }
}