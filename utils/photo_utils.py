import os
import pandas as pd
home_dir = '/Users/lylaatta/Documents/GitHub/LylaAtta.github.io'
photo_path = '/assets/img/photos/all/'
# fnames = os.listdir(home_dir+photo_path)
# fnames.remove('.DS_Store')
# fnames.sort()

# photo_dets = pd.DataFrame(fnames)
# photo_dets.columns = ['fname']
# photo_dets['location'] = ''
# photo_dets['year'] = ''
# photo_dets['camera'] = ''

save_path = '/assets/img/photos/photo_dets_test.csv'
# photo_dets.to_csv(home_dir+save_path, index=False)

dets_path = '/assets/img/photos/photo_dets_filled.csv'
photo_dets = pd.read_csv(home_dir+dets_path)
# print(photo_dets.head())

# paths = home_dir + photo_path + photo_dets['fname']
# photo_dets['path'] = paths
# print(photo_dets.head())
# photo_dets.to_csv(home_dir+save_path, index=False)

json_path = '/assets/img/photos/photo_dets_2.json'
photo_dets.to_json(home_dir+json_path, orient='records')
# print(photo_dets.head())
