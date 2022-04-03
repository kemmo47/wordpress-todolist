# Training Wordpress

* Include `docker-compose.yml` to this repository.
* Everyone launch server with `docker-compose up` on local device if we get source code from this repository.
* Everyone find out result page on local device web browser.
* Use `PHP7`, `Wordpress`, `Nginx`, `MySQL`.
* Add the necessary information to the `README.md`. The testers can launch the docker locally and describe it so that it can be viewed in a browser.


# Deliverable image

<img src="https://mevn-public.s3-ap-southeast-1.amazonaws.com/for-github-readme/Training_todo_web_app.gif"/>

* The design of the deliverables does not matter, but those that are too rough are NG. You can use any JS & CSS framework you like.
* Data should be persistent. The final data should be displayed even if it is accessed from another device.
* Use English instead of Japanese in the UI.


# Training flow

1. Picking and moving to KANBAN, Move to `in Development` in Projects/Startup.
2. Creating and developing git branches around KANBAN. The name of the git branch should be the number of the issue to be developed. For example, `issue-3`.
3. Develop it.
4. Notify with pull request when developping completed. In the pull request, be specific about what the tester should be testing.
5. KANBAN Move to `Waiting for verification`.
6. Tester performs test. You may proceed with the development of another KANBAN during the test.
6. If validation completes successfully, it is merged into master. If there are any deficiencies, the pull request and KANBAN will be returned.


# Usage

* To get started, make sure you have Docker installed on your system.

* And then clone this:
```
git clone git@github.com:marketenterprise/Training-Long-Wordpress.git
```

* `cd Training-Long-Wordpress` & `git checkout issue-N` (checkout to the issue you want to run).

```
docker-compose up
```

### **Web server running on port 80**

The containers are up and running. Time to verify everything is working by visiting in your browser at http://localhost/.

***
