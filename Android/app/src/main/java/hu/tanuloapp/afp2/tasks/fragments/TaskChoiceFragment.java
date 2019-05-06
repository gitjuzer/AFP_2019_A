package hu.tanuloapp.afp2.tasks.fragments;

import android.os.Bundle;
import android.os.Handler;
import android.os.Looper;
import android.support.annotation.NonNull;
import android.support.v4.app.Fragment;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.Spinner;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.IOException;
import java.util.ArrayList;
import java.util.List;
import java.util.Objects;

import hu.tanuloapp.afp2.R;
import okhttp3.Call;
import okhttp3.Callback;
import okhttp3.HttpUrl;
import okhttp3.MediaType;
import okhttp3.OkHttpClient;
import okhttp3.Request;
import okhttp3.Response;

public class TaskChoiceFragment extends Fragment implements AdapterView.OnItemSelectedListener {

    private static ArrayList<String> tasksname = new ArrayList<>();
    //private static String[] tasksname = {"asd","gdfg","bnbn"};
    private static String choosedTask;

    public TaskChoiceFragment(){

    }

    public static void getTasks(StatusCallback statusCallback){
        OkHttpClient okHttpClient = new OkHttpClient();

        HttpUrl httpUrl = new HttpUrl.Builder()
                .scheme("http")
                .host(" www.afp2019a.nhely.hu")
                .port(80)
                .addPathSegment("public")
                .addPathSegment("quiz")
                .build();

        MediaType JSON = MediaType.parse("application/json; charset=utf-8");

        Request request = new Request.Builder()
                .url(httpUrl)
                .build();

        Log.d("afp","taskchoice: getting tasks -> "+request.toString());

        okHttpClient.newCall(request).enqueue(new Callback() {
            @Override
            public void onFailure(@NonNull final Call call, @NonNull final IOException e) {
                Log.e("afp", "onFailure: " + e.getLocalizedMessage(), e);
                new Handler(Looper.getMainLooper()).post(() -> statusCallback.onFailure(e.getLocalizedMessage()));
            }

            @Override
            public void onResponse(@NonNull Call call,@NonNull final Response response) throws IOException {
                final String result = Objects.requireNonNull(response.body()).string();
                Log.d("afp", "onResponse: " + result);
                if(response.isSuccessful()){
                    new Handler(Looper.getMainLooper()).post(() -> {
                        try {
                            if (new JSONObject(result).getInt("status") == 0) {
                                statusCallback.onFailure(new JSONObject(result).getString("status_message"));
                            } else if (new JSONObject(result).getInt("status") == 1) {
                                JSONObject jsonResult = new JSONObject(result);
                                statusCallback.onSuccess(jsonResult.getInt("id")+jsonResult.getString("cim"));
                                tasksname.add(jsonResult.getString("cim"));
                            }
                        } catch (JSONException e) {
                            Log.e("afp", "onResponse: " + e.getLocalizedMessage(), e);
                            statusCallback.onFailure(e.getLocalizedMessage());
                        }
                    });
                }else{
                    new Handler(Looper.getMainLooper()).post(() -> statusCallback.onFailure("Something went wrong"));
                }
            }
        });
    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {

        View view = inflater.inflate(R.layout.fragment_quizselection, container, false);

        Button choose = view.findViewById(R.id.button);
        Spinner spinner = (Spinner)view.findViewById(R.id.spinnerquizselection);
        //ArrayAdapter<CharSequence> adapter = ArrayAdapter.createFromResource(this, tasksname, android.R.layout.simple_spinner_item);
        //ArrayAdapter<String> adapter = new ArrayAdapter<String>(this, android.R.layout.simple_spinner_dropdown_item,tasksname);
        //spinner.setAdapter(adapter);
        //adapter.setDropDownViewResource(android.R.layout.simple_spinner_dropdown_item);
        //spinner.setAdapter(adapter);
        //spinner.setOnItemSelectedListener(this);


        choose.setOnClickListener(v -> {

        });

        return view;
        //return super.onCreateView(inflater, container, savedInstanceState);
    }

    @Override
    public void onItemSelected(AdapterView<?> parent, View view, int position, long id) {
        choosedTask = parent.getItemAtPosition(position).toString();
    }

    @Override
    public void onNothingSelected(AdapterView<?> parent) {

    }

    public interface StatusCallback {
        void onSuccess(String response);

        void onFailure(String message);
    }
}
