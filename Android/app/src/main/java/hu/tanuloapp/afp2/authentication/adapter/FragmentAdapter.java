package hu.tanuloapp.afp2.authentication.adapter;

import android.support.v4.app.Fragment;
import android.support.v4.app.FragmentManager;
import android.support.v4.app.FragmentPagerAdapter;

import hu.tanuloapp.afp2.authentication.fragments.LoginFragment;
import hu.tanuloapp.afp2.authentication.fragments.RegistrationFragment;

public class FragmentAdapter extends FragmentPagerAdapter {

    FragmentAdapter(FragmentManager fm) {
        super(fm);
    }

    @Override
    public Fragment getItem(int position) {
        switch (position) {
            case 0:
                return new LoginFragment();
            case 1:
                return new RegistrationFragment();
            default:
                return new LoginFragment();
        }
    }

    @Override
    public int getCount() {
        return 2;
    }

}
