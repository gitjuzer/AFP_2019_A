package hu.tanuloapp.afp2.authentication;

import android.os.Bundle;
import android.support.v4.view.ViewPager;
import android.support.v7.app.AppCompatActivity;

import hu.tanuloapp.afp2.R;
import hu.tanuloapp.afp2.authentication.adapter.FragmentAdapter;

public class AuthenticationActivity extends AppCompatActivity {


    public ViewPager viewPager;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_authentication);

        viewPager = findViewById(R.id.viewPager);
        if (viewPager != null) {
            FragmentAdapter adapter = new FragmentAdapter(getSupportFragmentManager());
            viewPager.setAdapter(adapter);
        }

    }

    public ViewPager getViewPager() {
        return viewPager;
    }
}
