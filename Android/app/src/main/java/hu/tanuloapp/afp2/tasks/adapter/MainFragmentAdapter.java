package hu.tanuloapp.afp2.tasks.adapter;

import android.support.v4.app.Fragment;
import android.support.v4.app.FragmentManager;
import android.support.v4.app.FragmentPagerAdapter;

import hu.tanuloapp.afp2.tasks.fragments.QuizFragment;

public class MainFragmentAdapter  extends FragmentPagerAdapter{

    public MainFragmentAdapter(FragmentManager fm){super(fm);}

    @Override
    public Fragment getItem(int position) {
        switch (position){
            case 0:
                return new QuizFragment();
            case 1:
                return null;
            case 2:
                return null;
            case 3:
                return null;
            case 4:
                return null;
            case 5:
                return null;
            case 6:
                return null;
            case 7:
                return null;
            default:
                return null;
        }
    }

    @Override
    public int getCount() {
        return 8;
    }
}
