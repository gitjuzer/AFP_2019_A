package hu.tanuloapp.afp2.tasks.fragments;

import android.os.Bundle;
import android.support.v4.app.Fragment;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;

import hu.tanuloapp.afp2.R;

public class ToplistFragment extends Fragment {

    public ToplistFragment(){

    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {
        return inflater.inflate(R.layout.fragment_toplist, container, false);
    }
}
