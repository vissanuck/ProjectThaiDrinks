package com.example.project;


import android.content.DialogInterface;
import android.content.Intent;
import android.os.AsyncTask;
import android.os.Bundle;
import android.support.v7.app.AlertDialog;
import android.support.v7.app.AppCompatActivity;
import android.view.MenuItem;
import android.view.View;
import android.view.WindowManager;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Spinner;
import android.widget.TextView;
import android.widget.Toast;

import com.squareup.picasso.Picasso;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.HashMap;

import de.hdodenhof.circleimageview.CircleImageView;

public class ProfileActivity extends AppCompatActivity {
    String userid, name, phone, location;
    Spinner sploc;
    TextView tvphone, tvlocation;
    EditText tvuserid, tvname, edolpass, ednewpass;
    CircleImageView imgprofile;
    Button btnUpdate;

    @Override
    protected void onCreate(Bundle savedInstanceState){
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_profile);
        Intent intent = getIntent();
        Bundle bundle = intent.getExtras();
        imgprofile = findViewById(R.id.imageView4);
        tvuserid = findViewById(R.id.txtemail);
        tvname = findViewById(R.id.txtUsername);
        tvphone = findViewById(R.id.txtphone);
        edolpass = findViewById(R.id.txtoldpassword);
        ednewpass = findViewById(R.id.txtnewpassword);
        sploc = findViewById(R.id.spinLoc);
        btnUpdate = findViewById(R.id.button5);

        userid = bundle.getString("userid");
        name = bundle.getString("name");
        phone = bundle.getString("phone");

        tvphone.setText(phone);
        String image_url ="http://githubbers.com/vissanuck/profileimages/"+ phone + ".jpg";
        Picasso.with(this).load(image_url)
        .resize(300,300).into(imgprofile);
        getSupportActionBar().setDisplayHomeAsUpEnabled(true);
        loadUserProfile();
        btnUpdate.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                String newemail = tvuserid.getText().toString();
                String newname = tvname.getText().toString();
                String oldpass = edolpass.getText().toString();
                String newpass = ednewpass.getText().toString();
                String newloc = sploc.getSelectedItem().toString();
                dialogUpdate(newemail, newname, newloc, oldpass, newpass);

            }
        });
        this.getWindow().setSoftInputMode(WindowManager.LayoutParams.SOFT_INPUT_STATE_ALWAYS_HIDDEN);


            }
    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        switch (item.getItemId()) {
            case android.R.id.home:
                Intent intent = new Intent(ProfileActivity.this, MainActivity.class);
                Bundle bundle = new Bundle();
                bundle.putString("userid", userid);
                bundle.putString("name", name);
                bundle.putString("phone", phone);
                intent.putExtras(bundle);
                intent.setFlags(Intent.FLAG_ACTIVITY_NO_HISTORY);
                startActivity(intent);
                this.finish();
                return true;
            default:
                return super.onOptionsItemSelected(item);
        }
    }

         void loadUserProfile(){
          class LoadUserProfile extends AsyncTask<Void,Void,String> {

              @Override
              protected String doInBackground(Void... voids) {
                  HashMap<String, String> hashMap = new HashMap<>();
                  hashMap.put("userid", phone);
                  RequestHandler rh = new RequestHandler();
                  String s = rh.sendPostRequest("http://githubbers.com/vissanuck/load_user.php", hashMap);
                  return s;
              }

              @Override
              protected void onPostExecute(String s) {
                  super.onPostExecute(s);
                  //Toast.makeText(ProfileActivity.this, s, Toast.LENGTH_SHORT).show();
                  try {
                      JSONObject jsonObject = new JSONObject(s);
                      JSONArray restarray = jsonObject.getJSONArray("user");
                      JSONObject c = restarray.getJSONObject(0);
                      name = c.getString("name");
                      userid = c.getString("email");
                      location = c.getString("location");

                  } catch (JSONException e) {

                  }
                  //Log.e("LOC",location);
                  for (int i = 0; i < sploc.getCount(); i++) {
                      if (sploc.getItemAtPosition(i).toString().equalsIgnoreCase(location)) {
                          sploc.setSelection(i);
                      }
                  }
                  tvuserid.setText(userid);
                  tvname.setText(name);
              }
          }
              LoadUserProfile loadUserProfile = new LoadUserProfile();
              loadUserProfile.execute();
         }
         void updateProfile(final String newemail, final String newname, final String newloc, final String oldpass, final String newpass) {
            class UpdateProfile extends AsyncTask<Void, Void, String> {

            @Override
            protected String doInBackground(Void... voids) {
                HashMap<String, String> hashMap = new HashMap<>();
                hashMap.put("email", newemail);
                hashMap.put("name", newname);
                hashMap.put("phone", phone);
                hashMap.put("opassword", oldpass);
                hashMap.put("npassword", newpass);
                hashMap.put("newloc", newloc);
                RequestHandler rh = new RequestHandler();
                String s = rh.sendPostRequest("http://githubbers.com/vissanuck/update_profile.php", hashMap);
                return s;
            }

            @Override
            protected void onPostExecute(String s) {
                super.onPostExecute(s);
                if (s.equalsIgnoreCase("success")) {
                    Toast.makeText(ProfileActivity.this, "Success", Toast.LENGTH_SHORT).show();
                    Intent intent = new Intent(ProfileActivity.this, MainActivity.class);
                    Bundle bundle = new Bundle();
                    bundle.putString("userid", userid);
                    bundle.putString("name", name);
                    bundle.putString("phone", phone);
                    intent.putExtras(bundle);
                    intent.setFlags(Intent.FLAG_ACTIVITY_NO_HISTORY);
                    startActivity(intent);
                } else {
                    Toast.makeText(ProfileActivity.this, "Failed", Toast.LENGTH_SHORT).show();
                }
            }
        }
        UpdateProfile updateProfile = new UpdateProfile();
        updateProfile.execute();
    }

    private void dialogUpdate(final String newemail, final String newname, final String newloc, final String oldpass, final String newpass) {
        AlertDialog.Builder alertDialogBuilder = new AlertDialog.Builder(this);
        alertDialogBuilder.setTitle("Profile");

        alertDialogBuilder
                .setMessage("Update this profile")
                .setCancelable(false)
                .setPositiveButton("Yes",new DialogInterface.OnClickListener() {
                    public void onClick(DialogInterface dialog,int id) {
                        updateProfile(newemail, newname, newloc, oldpass, newpass);
                    }
                })
                .setNegativeButton("No",new DialogInterface.OnClickListener() {
                    public void onClick(DialogInterface dialog,int id) {
                        dialog.cancel();
                    }
                });
        AlertDialog alertDialog = alertDialogBuilder.create();
        alertDialog.show();

    }


}
